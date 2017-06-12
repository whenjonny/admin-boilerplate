<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use InfyOm\Generator\Utils\FileUtil;
use InfyOm\Generator\Utils\GeneratorFieldsInputUtil;

class InfyomParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infyom:parser {ModelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse file into json';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Usage: php artisan infyom:parser {ModelName}');
        $modelName = $this->argument('ModelName');
        $path = config('infyom.laravel_generator.path.schema_files', base_path('resources/model_schemas/'));
        $filePath = $path.$modelName;

        while(!is_file($filePath)) {
            $this->info('Please give me valid relative file path');
            $filePath = $this->ask('What is your infyom file path?');
        }
        $fields = explode("\n", file_get_contents($filePath));

        $fileFields = [];
        $fileFields[] = self::gen('id increments null null p');

        foreach ($fields as $row) {
        
            if($row== '') {
                continue;
            }
            if(starts_with($row, 'id')) {
                continue;
            }
            if(starts_with($row, 'updated_at')) {
                continue;
            }
            if(starts_with($row, 'created_at')) {
                continue;
            }
            if(starts_with($row, 'deleted_at')) {
                continue;
            }
            if(starts_with($row, 'status')) {
                continue;
            }

            $fileFields[] = self::gen($row);
        }

        $fileFields[] = self::gen('status integer:nullable:default,1 null null f,if,ii');
        $fileFields[] = self::gen('updated_at timestamp null null s,f,if,ii');
        $fileFields[] = self::gen('created_at timestamp null null s,f,if,ii');

        $fileName = $modelName.'.json';

        if (file_exists($path.$fileName) && !$this->confirm($fileName.' already exists. Do you want to overwrite it? [y|N]')) {
            return;
        }

        FileUtil::createFile($path, $fileName, json_encode($fileFields, JSON_PRETTY_PRINT));
        $this->info("\nSchema File saved: ");
        $this->info($fileName);

        if($this->confirm('Do you want to generate code?')) {
            $this->call('infyom:scaffold', [
            'model'=>$modelName, '--fieldsFile'=>$path.$fileName
            ]);
        }
    }

    protected static function gen($row) {

        $result = [
            'name'        => '',
            'dbType'      => '',
            'htmlType'    => null,
            'validations' => null,
            'searchable'  => true,
            'fillable'    => true,
            'inForm'      => true,
            'inIndex'     => true,
            'primary'     => false
        ];

        $fields = explode(' ', trim($row));
        switch(sizeof($fields)) {
            case 5:
                $options = strtolower($fields[4]);
                $optionsArr = explode(',', $options);
                if (in_array('s', $optionsArr)) {
                    $result['searchable'] = false;
                }
                if (in_array('p', $optionsArr)) {
                    // if field is primary key, then its not searchable, fillable, not in index & form
                    $result['primary'] = true;
                    $result['searchable'] = false;
                    $result['fillable'] = false;
                    $result['inForm'] = false;
                    $result['inIndex'] = false;
                }
                if (in_array('f', $optionsArr)) {
                    $result['fillable'] = false;
                }
                if (in_array('if', $optionsArr)) {
                    $result['inForm'] = false;
                }
                if (in_array('ii', $optionsArr)) {
                    $result['inIndex'] = false;
                }
            case 4:
                $result['validations']  = $fields[3];
            case 3:
                $result['htmlType'] = $fields[2];
            case 2:
                $result['dbType']   = $fields[1];
            case 1:
                $result['name']     = $fields[0];
        }

        return $result;
    }

}
