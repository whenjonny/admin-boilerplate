<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use InfyOm\Generator\Utils\FileUtil;
use InfyOm\Generator\Utils\GeneratorFieldsInputUtil;

class InfyomRest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infyom:rest {ModelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse json to Api, after parser';

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

        if($this->confirm('Do you want to generate code?')) {
            $this->call('infyom:api', [
                'model'=>$modelName, '--fieldsFile'=>$path.$modelName.".json", '--skip'=>'migration'
            ]);
        }
    }
}
