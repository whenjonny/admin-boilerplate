<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use InfyOm\Generator\Utils\FileUtil;
use InfyOm\Generator\Utils\GeneratorFieldsInputUtil;
use InfyOm\Generator\Utils\TableFieldsGenerator;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


class InfyomParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infyom:parser {ModelName} {TableName?}';

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
        //return $this->refreshScaffold('Post');

        $this->info('Usage: php artisan infyom:parser {ModelName} {TableName?}');
        $modelName = $this->argument('ModelName');
        $tableName = $this->argument('TableName');


        if($tableName) {
            $fields = $this->fromTable($modelName, $tableName);
        }
        else {
            $fields= $this->fromFile($modelName);
        }

        if(empty($fields)) {
            return false;
        }
        
        if($this->confirm('Do you want to generate trans?')) {
            self::i18n($modelName, $fields);
            $this->info('language generate successfully');
        }
    }

    protected function refreshScaffold($modelName) {
        $tableName = Str::camel(Str::plural($modelName));
        //menu
        $menuPath = config(
            'infyom.laravel_generator.path.views',
            base_path('resources/views/')
        ).config('infyom.laravel_generator.add_on.menu.menu_file');

        $templatePath = config('infyom.laravel_generator.path.templates_dir').'scaffold/layouts/menu_template.stub';
        $templateData = file_get_contents($templatePath);

        $templateData = str_replace('$ROUTE_NAMED_PREFIX$', '',$templateData);
        $templateData = str_replace('$MODEL_NAME_PLURAL_CAMEL$', $tableName,$templateData);

        $menuData = file_get_contents($menuPath);
        $menuData = str_replace($templateData, '', $menuData);
        file_put_contents($menuPath, $menuData);

        //route
        $routePath = config('infyom.laravel_generator.path.routes');
        $templatePath = config('infyom.laravel_generator.path.templates_dir').'scaffold/routes/routes.stub';
        $templateData = file_get_contents($templatePath);

        $templateData = str_replace('$PATH_PREFIX$', '',$templateData);
        $templateData = str_replace('$MODEL_NAME_PLURAL_CAMEL$', $tableName,$templateData);
        $templateData = str_replace('$MODEL_NAME$', $modelName, $templateData);

        $routeData = file_get_contents($routePath);
        $routeData = str_replace($templateData, '', $routeData);
        file_put_contents($routePath, $routeData);
    }

    protected function fromTable($modelName, $tableName) {
        if($tableName != Str::camel(Str::plural($modelName))) {
            $this->info('table name not in accordance with the rules');
            return false;
        }

        $tableFieldsGenerator = new TableFieldsGenerator($tableName);
        $tableFieldsGenerator->prepareFieldsFromTable();
        #$tableFieldsGenerator->prepareRelations();

        $fields = $tableFieldsGenerator->fields;

        $fieldsArr = [];
        foreach($fields as $field) {
            $fieldsArr[] = $field->name;
        }

        if($this->confirm('Do you want to generate code?')) {
            $this->removeMenu($modelName);
            $this->call('infyom:scaffold', [
                'model'=>$modelName, 
                '--fromTable'=>true,
                '--tableName'=>$tableName,
                '--skip' => 'migration'
            ]);
        }

        return $fieldsArr;
    }

    protected function fromFile($modelName) {
        $tableName = Str::camel(Str::plural($modelName));
        $path = config('infyom.laravel_generator.path.schema_files', base_path('resources/model_schemas/'));
        $filePath = $path.$modelName;

        while(!is_file($filePath)) {
            $this->info('Please give me valid relative file path');
            $filePath = $this->ask('What is your infyom file path?');
        }
        $fields = explode("\n", file_get_contents($filePath));

        $fileFields = [];
        $fileFields[] = self::gen('id increments null null p');

        $names = [];

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

            $row = self::gen($row);
            $fileFields[] = $row;
            $names[] = $row['name'];
        }

        $fileFields[] = self::gen('status integer:nullable:default,1 null null f,if,ii');
        $fileFields[] = self::gen('updated_at timestamp null null s,f,if,ii');
        $fileFields[] = self::gen('created_at timestamp null null s,f,if,ii');

        $names[] = 'status';
        $names[] = 'updated_at';
        $names[] = 'created_at';

        $fileName = $modelName.'.json';

        if (file_exists($path.$fileName) && !$this->confirm($fileName.' already exists. Do you want to overwrite it? [y|N]')) {
            $this->info('Exit without any change.');
            return $names;
        }

        FileUtil::createFile($path, $fileName, json_encode($fileFields, JSON_PRETTY_PRINT));
        $this->info("\nSchema File saved: $fileName");

        $skip = 'migration';
        try{
            $migration = \DB::table('migrations')->where('migration', 'LIKE', "%create_{$tableName}_table%")->first();
        } catch(\Exception $e) {
            $migration = null;
        }
        $tip = !$migration ? 'Do you want to generate migration?' : 'Model Exists, do you want to generate migration & refresh?';
        if($this->confirm($tip)) {
            $skip = '';
        }
        if($skip == '' && $migration) {
            $migratePath = config('infyom.laravel_generator.path.migration').$migration->migration.".php";
            $this->call('migrate:reset');
            unlink($migratePath);
            exec('composer dump-autoloaded');
        }

        if($this->confirm('Do you want to generate code?')) {
            $this->refreshScaffold($modelName);
            $this->call('infyom:scaffold', [
                'model'=>$modelName, '--fieldsFile'=>$path.$fileName, '--skip'=>$skip
            ]);
        }
        return $names;
    }


    protected static function i18n($modelName, $names) {
        $languages = config('locale.languages');

        $modelArr = [];
        $tableName = Str::camel(Str::plural($modelName));
        foreach($names as $row) {
            $modelArr[$row] = Str::title($row);
        }
        $modelArr['__TABLENAME__'] = Str::title($tableName);
        $modelArr['id'] = Str::title('ID');

        foreach($languages as $key=>$lang) {
            $backend = [];
            $filePath = base_path("resources/lang/$key/backend.php");
            if(!file_exists($filePath)) {
                $backend = [];
            }
            else {
                $backend = require_once($filePath);
            }

            if($key == 'zh-CN') {
                $modelArr['updated_at'] = '更新时间';
                $modelArr['created_at'] = '创建时间';
                $modelArr['deleted_at'] = '删除时间';
                $modelArr['status'] = '状态';
            }
            else {
                $modelArr['updated_at'] = Str::title('updated_at');
                $modelArr['created_at'] = Str::title('created_at');
                $modelArr['deleted_at'] = Str::title('deleted_at');
                $modelArr['status'] = Str::title('status');
            }

            $backend[$tableName] = $modelArr;
            $text='<?php return '.var_export($backend, true).';';
            file_put_contents($filePath, $text);
        }
    }

    protected static function gen($row) {

        $result = [
            'name'        => '',
            'dbType'      => '',
            'htmlType'    => '',
            'validations' => '',
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
                $result['validations']  = $fields[3]!="null"?$fields[3]:'';
            case 3:
                $result['htmlType'] = $fields[2]!="null"?$fields[2]:'';
            case 2:
                $result['dbType']   = $fields[1]!="null"?$fields[1]:'';
            case 1:
                $result['name']     = $fields[0]!="null"?$fields[0]:'';
        }

        return $result;
    }

}
