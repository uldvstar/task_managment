<?php

namespace App\Classes\CodeGenerator\Generators\Scaffold;

use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Generators\BaseGenerator;
use App\Classes\CodeGenerator\Utils\FileUtil;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ControllersGenerator extends BaseGenerator
{
    /** @var CommandData */
    private $commandData;

    /** @var string */
    private $path;


    public function __construct(CommandData $commandData)
    {

        parent::__construct();

        $this->commandData = $commandData;
        $this->path = $commandData->config->pathController.'/'.str::pluralStudly($this->commandData->modelName).'/';
    }

    public function generate()
    {

        foreach(['create', 'list', 'fetch', 'update', 'delete'] as $type){

            $name = $type === 'list' ? str::pluralStudly($this->commandData->modelName) : str::singular($this->commandData->modelName);
            $filename = str::studly($type.$name).'Controller.php';

            $templateData = $this->generatorHelpers->get_template("Scaffold.Controllers.".$type."_controller");

            $templateData = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $templateData);

            FileUtil::createFile($this->path, $filename, $templateData);

            $this->commandData->commandComment("\n" . $type . " Controller created: ");
            $this->commandData->commandInfo($filename);
        }

    }

    public function rollback()
    {
        foreach(['create', 'list', 'fetch', 'update', 'delete'] as $type){

            $name = $type === 'list' ? str::pluralStudly($this->commandData->modelName) : str::singular($this->commandData->modelName);
            $filename = str::studly($type.$name).'Controller.php';

            if ($this->rollbackFile($this->path, $filename)) {
                $this->commandData->commandComment($type . ' Controller file deleted: '.$filename);
            }
        }

        File::deleteDirectory($this->path);

    }
}
