<?php

namespace App\Classes\CodeGenerator\Commands\Scaffold;


use App\Classes\CodeGenerator\Commands\BaseCommand;
use App\Classes\CodeGenerator\Common\CommandData;

class MicroGeneratorCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'code:micro';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all files required for CRUD operations';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->commandData = new CommandData($this, 'micro');
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        parent::handle();

        if ($this->checkIsThereAnyDataToGenerate()) {

            $this->generateCommonItems();
            
            $this->generateMicroItems();

            $this->performPostActionsWithMigration();

        } else {

            $this->commandData->commandInfo('There are not enough input fields for scaffold generation.');

        }
    }


    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return array_merge(parent::getOptions(), []);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array_merge(parent::getArguments(), []);
    }

    /**
     * Check if there is anything to generate.
     *
     * @return bool
     */
    protected function checkIsThereAnyDataToGenerate()
    {
        if (count($this->commandData->fields) > 1) {
            return true;
        }
    }
}
