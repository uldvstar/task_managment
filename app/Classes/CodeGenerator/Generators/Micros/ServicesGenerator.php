<?php

namespace App\Classes\CodeGenerator\Generators\Micros;


use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Generators\BaseGenerator;
use App\Classes\CodeGenerator\Utils\FileUtil;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServicesGenerator extends BaseGenerator
{

    /** @var CommandData */
    private $commandData;

    /** @var string */
    private $path;



    /**
     * FactoryGenerator constructor.
     *
     * @param CommandData $commandData
     */
    public function __construct(CommandData $commandData)
    {

        parent::__construct();

        $this->commandData = $commandData;
        $this->path = app_path('Classes/Modules/'. str::pluralStudly($this->commandData->modelName).'/Services/');
    }

    public function generate()
    {
        foreach(['create', 'list', 'fetch', 'update', 'delete'] as $type){
            $name = $type === 'list' ? str::pluralStudly($this->commandData->modelName) : str::singular($this->commandData->modelName);
            $filename = str::studly($type.($type === 'fetch'?'es':'s').$name).'.php';

            $templateData = $this->generatorHelpers->get_template("Services.".str::snake($type.'_service'));

            $templateData = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $templateData);

            $templateData = str_replace(
                '$FIELDS$',
                implode($this->generatorHelpers->generator_nl_tab(1, 2), $this->generateFields()),
                $templateData
            );


            FileUtil::createFile($this->path, $filename, $templateData);

            $this->commandData->commandComment("\n" . $type . " service class created: ");
            $this->commandData->commandObj->info($filename);

        }

    }


    private function generateFields()
    {

        $fields = [];

        foreach ($this->commandData->fields as $field) {

            if(!in_array($field->name, $this->commandData->config->excludeFields())) {

                $getterName = $field->dbInput === 'boolean' ? 'is' . str::studly($field->name) : 'get' . str::studly($field->name);

                $field = "$" . "model->" . $field->name . " = $" . "object->" . $getterName . "();";
                $fields[] = $field;
            }
        }

        return $fields;
    }

    public function rollback()
    {

        foreach(['create', 'list', 'fetch', 'update', 'delete'] as $type){
            $name = $type === 'list' ? str::pluralStudly($this->commandData->modelName) : str::singular($this->commandData->modelName);
            $filename = str::studly($type.($type === 'fetch'?'es':'s').$name).'.php';
            if ($this->rollbackFile($this->path, $filename)) {
                $this->commandData->commandComment( $type . ' service class file deleted: '.$filename);
            }
        }

        File::deleteDirectory(($this->path));
    }
}