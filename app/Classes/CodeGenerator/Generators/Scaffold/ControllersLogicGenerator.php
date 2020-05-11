<?php

namespace App\Classes\CodeGenerator\Generators\Scaffold;

use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Generators\BaseGenerator;
use App\Classes\CodeGenerator\Utils\FileUtil;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ControllersLogicGenerator extends BaseGenerator
{
    /** @var CommandData */
    private $commandData;

    /** @var string */
    private $path;


    public function __construct(CommandData $commandData)
    {

        parent::__construct();

        $this->commandData = $commandData;
        $this->path = app_path('Classes/Modules/'. str::pluralStudly($this->commandData->modelName).'/ControllerLogic/');
    }

    public function generate()
    {

        foreach(['create', 'list', 'fetch', 'update', 'delete'] as $type){

            $name = $type === 'list' ? str::pluralStudly($this->commandData->modelName) : str::singular($this->commandData->modelName);
            $filename = str::studly($type.$name).'ControllerLogic.php';

            $templateData = $this->generatorHelpers->get_template("Scaffold.ControllersLogic.".$type."_controller_logic");

            $templateData = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $templateData);

            $templateData = str_replace(
                '$REQUEST_FIELDS$',
                implode(', ', $this->generateFields()),
                $templateData
            );


            FileUtil::createFile($this->path, $filename, $templateData);

            $this->commandData->commandComment("\n" . $type . " Controller logic created: ");
            $this->commandData->commandInfo($filename);
        }

    }

    private function generateFields(){
        $fields = [];

        foreach ($this->commandData->fields as $field) {
            if(!in_array($field->name, $this->commandData->config->excludeFields())) {
                $fields[] = '$request->input(\'' . $field->name . '\')';
            }
        }

        return $fields;
    }

    public function rollback()
    {
        foreach(['create', 'list', 'fetch', 'update', 'delete'] as $type){

            $name = $type === 'list' ? str::pluralStudly($this->commandData->modelName) : str::singular($this->commandData->modelName);
            $filename = str::studly($type.$name).'ControllerLogic.php';

            if ($this->rollbackFile($this->path, $filename)) {
                $this->commandData->commandComment($type . ' Controller logic file deleted: '.$filename);
            }
        }

        File::deleteDirectory($this->path);

    }
}
