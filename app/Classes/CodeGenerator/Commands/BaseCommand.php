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
use App\Classes\CodeGenerator\Utils\FileUtil;
use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class BaseCommand extends Command
{
    /**
     * The command Data.
     *
     * @var CommandData
     */
    public $commandData;

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

    public function handle()
    {
        $this->commandData->modelName = $this->argument('model');

        $this->commandData->initCommandData();
        $this->commandData->getFields();
    }

    public function generateCommonItems()
    {
        if (!$this->commandData->getOption('fromTable')) {
            $migrationGenerator = new MigrationGenerator($this->commandData);
            $migrationGenerator->generate();
        }

        $modelGenerator = new ModelGenerator($this->commandData);
        $modelGenerator->generate();

        $factoryGenerator = new FactoryGenerator($this->commandData);
        $factoryGenerator->generate();

        $seederGenerator = new SeederGenerator($this->commandData);
        $seederGenerator->generate();

        if($this->confirm("\nDo you want to include this seeder to the main seeder? [y|N]", false)){
            $seederGenerator->updateMainSeeder();
        }

    }

    public function generateMicroItems()
    {
        $dataTransferObjectGenerator = new DataTransferObjectGenerator($this->commandData);
        $dataTransferObjectGenerator->generate();

        $serviceGenerator = new ServicesGenerator($this->commandData);
        $serviceGenerator->generate();
    }

    public function generateScaffoldItems()
    {

        $resourceGenerator = new ResourceGenerator($this->commandData);
        $resourceGenerator->generate();

        $validatorsGenerator = new ValidatorsGenerator($this->commandData);
        $validatorsGenerator->generate();

        $rulesGenerator = new RulesGenerator($this->commandData);
        $rulesGenerator->generate();

        $routesGenerator = new RoutesGenerator($this->commandData);
        $routesGenerator->generate();

        $webRouteGenerator = new WebRouteGenerator($this->commandData);
        $webRouteGenerator->generate();

        if (!$this->isSkip('controllers') and !$this->isSkip('scaffold_controller')) {
            $controllerGenerator = new ControllersGenerator($this->commandData);
            $controllerGenerator->generate();

            $controllerLogicGenerator = new ControllersLogicGenerator($this->commandData);
            $controllerLogicGenerator->generate();

        }
    }

    public function generateViews(){
        $viewGenerator = new ViewsGenerator($this->commandData);
        $viewGenerator->generate();

        $vueGenerator = new vueGenerator($this->commandData);
        $vueGenerator->generate();

        if($this->confirm("\nDo you want to compile your vue files? [y|N]", false)){
            shell_exec('yarn dev');
        }
    }

    public function performPostActions($runMigration = false)
    {
        if ($this->commandData->getOption('save')) {
            $this->saveSchemaFile();
        }

        if ($runMigration) {
            if ($this->commandData->getOption('forceMigrate')) {
                $this->runMigration();
            } elseif (!$this->commandData->getOption('fromTable') and !$this->isSkip('migration')) {
                $requestFromConsole = (php_sapi_name() == 'cli') ? true : false;
                if ($this->commandData->getOption('jsonFromGUI') && $requestFromConsole) {
                    $this->runMigration();
                } elseif ($requestFromConsole && $this->confirm("\nDo you want to migrate database? [y|N]", false)) {
                    $this->runMigration();
                }
            }
        }

        if (!$this->isSkip('dump-autoload')) {
            $this->info('Generating autoload files');
            $this->composer->dumpOptimized();
        }
    }

    public function runMigration()
    {
        $migrationPath = database_path('migrations/');
        $path = Str::after($migrationPath, base_path()); // get path after base_path
        $this->call('migrate', ['--path' => $path, '--force' => true]);

        return true;
    }

    public function isSkip($skip)
    {
        if ($this->commandData->getOption('skip')) {
            return in_array($skip, (array) $this->commandData->getOption('skip'));
        }

        return false;
    }

    public function performPostActionsWithMigration()
    {
        $this->performPostActions(true);
    }

    private function saveSchemaFile()
    {
        $fileFields = [];

        foreach ($this->commandData->fields as $field) {
            $fileFields[] = [
                'name'        => $field->name,
                'dbType'      => $field->dbInput,
                'htmlType'    => $field->htmlInput,
                'validations' => $field->validations,
                'searchable'  => $field->isSearchable,
                'fillable'    => $field->isFillable,
                'primary'     => $field->isPrimary,
                'inForm'      => $field->inForm,
                'inIndex'     => $field->inIndex,
                'inView'      => $field->inView,
            ];
        }

        foreach ($this->commandData->relations as $relation) {
            $fileFields[] = [
                'type'     => 'relation',
                'relation' => $relation->type.','.implode(',', $relation->inputs),
            ];
        }

        $path = app_path('Classes/CodeGenerator/Schemas/');

        $fileName = $this->commandData->modelName.'.json';

        if (file_exists($path.$fileName) && !$this->confirmOverwrite($fileName)) {
            return;
        }
        FileUtil::createFile($path, $fileName, json_encode($fileFields, JSON_PRETTY_PRINT));
        $this->commandData->commandComment("\nSchema File saved: ");
        $this->commandData->commandInfo($fileName);
    }

    /**
     * @param $fileName
     * @param string $prompt
     *
     * @return bool
     */
    protected function confirmOverwrite($fileName, $prompt = '')
    {
        $prompt = (empty($prompt))
            ? $fileName.' already exists. Do you want to overwrite it? [y|N]'
            : $prompt;

        return $this->confirm($prompt, false);
    }


    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            ['fieldsFile', null, InputOption::VALUE_REQUIRED, 'Fields input as json file'],
            ['jsonFromGUI', null, InputOption::VALUE_REQUIRED, 'Direct Json string while using GUI interface'],
            ['plural', null, InputOption::VALUE_REQUIRED, 'Plural Model name'],
            ['tableName', null, InputOption::VALUE_REQUIRED, 'Table Name'],
            ['fromTable', null, InputOption::VALUE_NONE, 'Generate from existing table'],
            ['ignoreFields', null, InputOption::VALUE_REQUIRED, 'Ignore fields while generating from table'],
            ['save', null, InputOption::VALUE_NONE, 'Save model schema to file'],
            ['primary', null, InputOption::VALUE_REQUIRED, 'Custom primary key'],
            ['prefix', null, InputOption::VALUE_REQUIRED, 'Prefix for all files'],
            ['paginate', null, InputOption::VALUE_REQUIRED, 'Pagination for index.blade.php'],
            ['skip', null, InputOption::VALUE_REQUIRED, 'Skip Specific Items to Generate (migration,model,controllers,api_controller,scaffold_controller,repository,requests,api_requests,scaffold_requests,routes,api_routes,scaffold_routes,views,tests,menu,dump-autoload)'],
            ['datatables', null, InputOption::VALUE_REQUIRED, 'Override datatables settings'],
            ['views', null, InputOption::VALUE_REQUIRED, 'Specify only the views you want generated: index,create,edit,show'],
            ['relations', null, InputOption::VALUE_NONE, 'Specify if you want to pass relationships for fields'],
            ['softDelete', null, InputOption::VALUE_NONE, 'Soft Delete Option'],
            ['forceMigrate', null, InputOption::VALUE_NONE, 'Specify if you want to run migration or not'],
            ['factory', null, InputOption::VALUE_NONE, 'To generate factory'],
            ['seeder', null, InputOption::VALUE_NONE, 'To generate seeder'],
            ['localized', null, InputOption::VALUE_NONE, 'Localize files.'],
            ['repositoryPattern', null, InputOption::VALUE_REQUIRED, 'Repository Pattern'],
            ['connection', null, InputOption::VALUE_REQUIRED, 'Specify connection name'],
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
        ];
    }

}