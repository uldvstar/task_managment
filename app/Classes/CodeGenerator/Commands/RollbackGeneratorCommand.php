<?php

namespace App\Classes\CodeGenerator\Commands;

use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Generators\FactoryGenerator;
use App\Classes\CodeGenerator\Generators\Micros\DataTransferObjectGenerator;
use App\Classes\CodeGenerator\Generators\Micros\ResourceGenerator;
use App\Classes\CodeGenerator\Generators\Micros\RulesGenerator;
use App\Classes\CodeGenerator\Generators\Micros\ServicesGenerator;
use App\Classes\CodeGenerator\Generators\Micros\ValidatorsGenerator;
use App\Classes\CodeGenerator\Generators\MigrationGenerator;
use App\Classes\CodeGenerator\Generators\ModelGenerator;
use App\Classes\CodeGenerator\Generators\Scaffold\ControllersGenerator;
use App\Classes\CodeGenerator\Generators\Scaffold\ControllersLogicGenerator;
use App\Classes\CodeGenerator\Generators\Scaffold\RoutesGenerator;
use App\Classes\CodeGenerator\Generators\Scaffold\ViewsGenerator;
use App\Classes\CodeGenerator\Generators\Scaffold\VueGenerator;
use App\Classes\CodeGenerator\Generators\Scaffold\WebRouteGenerator;
use App\Classes\CodeGenerator\Generators\SeederGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RollbackGeneratorCommand extends Command
{
    /**
     * The command Data.
     *
     * @var CommandData
     */
    public $commandData;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'code:rollback';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'rollback all files required for CRUD operations';

    /**
     * @var Composer
     */
    public $composer;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        if (!in_array($this->argument('type'), [
            'scaffold', 'micro'
        ])) {
            $this->error('invalid rollback type');
        }

        $this->commandData = new CommandData($this, $this->argument('type'));
        $this->commandData->config->mName = $this->commandData->modelName = $this->argument('model');

        $this->commandData->config->init($this->commandData, ['tableName', 'prefix', 'plural', 'views']);

        $this->rollbackCommon();
        $this->rollbackMicros();

        if($this->commandData->commandType === 'scaffold'){

            $this->rollbackScaffold();
            $this->rollbackViews();

        }


        $this->info('Generating autoload files');
        $this->composer->dumpOptimized();
    }

    private function rollbackCommon(){
        $migrationGenerator = new MigrationGenerator($this->commandData);
        $migrationGenerator->rollback();

        $modelGenerator = new ModelGenerator($this->commandData);
        $modelGenerator->rollback();

        $factoryGenerator = new FactoryGenerator($this->commandData);
        $factoryGenerator->rollback();

        $seederGenerator = new SeederGenerator($this->commandData);
        $seederGenerator->rollback();
    }

    private function rollbackMicros(){

        $dataTransferObjectGenerator = new DataTransferObjectGenerator($this->commandData);
        $dataTransferObjectGenerator->rollback();

        $serviceGenerator = new ServicesGenerator($this->commandData);
        $serviceGenerator->rollback();

    }

    private function rollbackScaffold(){
        $resourceGenerator = new ResourceGenerator($this->commandData);
        $resourceGenerator->rollback();

        $validatorsGenerator = new ValidatorsGenerator($this->commandData);
        $validatorsGenerator->rollback();

        $rulesGenerator = new RulesGenerator($this->commandData);
        $rulesGenerator->rollback();

        File::deleteDirectories(app_path('Classes/Modules/'. str::pluralStudly($this->commandData->modelName).'/Standards/'));

        $routesGenerator = new RoutesGenerator($this->commandData);
        $routesGenerator->rollback();

        $webRouteGenerator = new WebRouteGenerator($this->commandData);
        $webRouteGenerator->rollback();

        $controllerGenerator = new ControllersGenerator($this->commandData);
        $controllerGenerator->rollback();

        $controllerLogicGenerator = new ControllersLogicGenerator($this->commandData);
        $controllerLogicGenerator->rollback();

        File::deleteDirectories(app_path('Classes/Modules/'. str::pluralStudly($this->commandData->modelName).'/'));

    }

    private function rollbackViews(){
        $viewGenerator = new ViewsGenerator($this->commandData);
        $viewGenerator->rollback();

        $vueGenerator = new vueGenerator($this->commandData);
        $vueGenerator->rollback();
    }



    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            ['tableName', null, InputOption::VALUE_REQUIRED, 'Table Name'],
            ['prefix', null, InputOption::VALUE_REQUIRED, 'Prefix for all files'],
            ['plural', null, InputOption::VALUE_REQUIRED, 'Plural Model name'],
            ['views', null, InputOption::VALUE_REQUIRED, 'Views to rollback'],
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['model', InputArgument::REQUIRED, 'Singular Model name'],
            ['type', InputArgument::REQUIRED, 'Rollback type: (micro / scaffold )'],
        ];
    }

}
