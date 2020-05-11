<?php

namespace App\Classes\CodeGenerator\Generators\Micros;


use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Generators\BaseGenerator;
use App\Classes\CodeGenerator\Utils\FileUtil;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RulesGenerator extends BaseGenerator
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
        $this->path = app_path('Classes/Modules/'. str::pluralStudly($this->commandData->modelName).'/Standards/Rules/');
    }

    public function generate()
    {
        foreach(['create', 'list', 'fetch', 'update', 'delete'] as $type){
            $name = $type === 'list' ? str::pluralStudly($this->commandData->modelName) : str::singular($this->commandData->modelName);
            $filename = 'Can'.str::studly($type.$name).'.php';
            $templateData = $this->generatorHelpers->get_template('Rules.can_'.$type);

            $templateData = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $templateData);

            FileUtil::createFile($this->path, $filename, $templateData);

            $this->commandData->commandComment("\n" . $type . " Rules created: ");
            $this->commandData->commandObj->info($filename);
        }

    }

    public function rollback()
    {
        foreach(['create', 'list', 'fetch', 'update', 'delete'] as $type){

            $name = $type === 'list' ? str::pluralStudly($this->commandData->modelName) : str::singular($this->commandData->modelName);
            $filename ='Can'.str::studly($type.$name).'.php';

            if ($this->rollbackFile($this->path, $filename)) {
                $this->commandData->commandComment($type . ' Rules file deleted: '.$filename);
            }
        }

        File::deleteDirectory($this->path);

    }
}