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
    protected $signature = 'infyom:parser {filePath}';

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
        $this->info('Usage: php artisan infyom:parser {filePath}');
        // 1. get file path
        $filePath = $this->argument('filePath');
        // 2. get file content
        while(!is_file($filePath)) {
            $this->info('Please give me valid file path');
            $filePath = $this->ask('What is your infyom file path?');
        }
        $fields = explode("\n", file_get_contents($filePath));

        $fileFields = [];
        $fileFields[] = [
            'name'        => 'id',
            'dbType'      => 'increments',
            'htmlType'    => null,
            'validations' => null,
            'searchable'  => true,
            'fillable'    => false,
            'inForm'      => false,
            'inIndex'     => true,
            'primary'     => true
        ];

        foreach ($fields as $row) {
            if($row== '') {
                continue;
            }
            $field = explode(' ', $row);
            if(in_array($field[0], array('id', 'updated_at', 'created_at', 'status'))) {
                continue;
            }

            $fileField = [
                'name'        => $field[0],
                'dbType'      => $field[1],
                'htmlType'    => $field[2],
                'searchable'  => true,
                'fillable'    => true,
                'inForm'      => true,
                'inIndex'     => true,
                'primary'     => false
            ];

            if(sizeof($field) >= 4) {
                $fileField['validations'] = $field[3];
            }
            if(sizeof($field) == 5) {
                $extra = explode(',', $field[4]);
                foreach($extra as $e) {
                    switch($e) {
                    case 's':
                        $fileField['searchable'] = false;
                        break;
                    case 'if':
                        $fileField['inForm'] = false;
                        break;
                    case 'ii':
                        $fileField['inIndex'] = false;
                        break;
                    case 'f':
                        $fileField['fillable'] = false;
                        break;
                    }
                }
            }

            $fileFields[] = $fileField;
        }
 
        $fileFields[] = [
            'name'        => 'status',
            'dbType'      => 'integer:nullable',
            'htmlType'    => null,
            'validations' => null,
            'searchable'  => true,
            'fillable'    => false,
            'inForm'      => false,
            'inIndex'     => false,
            'primary'     => false 
        ];

        
        $fileFields[] = [
            'name'        => 'updated_at',
            'dbType'      => 'timestamp',
            'htmlType'    => null,
            'validations' => null,
            'searchable'  => false,
            'fillable'    => false,
            'inForm'      => false,
            'inIndex'     => false,
            'primary'     => false 
        ];

        $fileFields[] = [
            'name'        => 'created_at',
            'dbType'      => 'timestamp',
            'htmlType'    => null,
            'validations' => null,
            'searchable'  => false,
            'fillable'    => false,
            'inForm'      => false,
            'inIndex'     => false,
            'primary'     => false 
        ];

        $path = config('infyom.laravel_generator.path.schema_files', base_path('resources/model_schemas/'));

        $modelName = explode('/', $filePath);
        $modelName = end($modelName);
        $fileName = $modelName.'.json';

        if (file_exists($path.$fileName) && !$this->confirmOverwrite($fileName)) {
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
    
    protected function confirmOverwrite($fileName, $prompt = '')
    {
        $prompt = (empty($prompt))
            ? $fileName.' already exists. Do you want to overwrite it? [y|N]'
            : $prompt;

        return $this->confirm($prompt, false);
    }

}
