<?php

namespace App\Classes\CodeGenerator\Generators\Scaffold;

use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Generators\BaseGenerator;
use App\Classes\CodeGenerator\Utils\FileUtil;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ViewsGenerator extends BaseGenerator
{
    /** @var CommandData */
    private $commandData;

    /** @var string */
    private $path;

    /** @var string */
    private $fileName;


    public function __construct(CommandData $commandData)
    {

        parent::__construct();

        $this->commandData = $commandData;
        $this->path = resource_path('views/pages/'.str::plural(str::snake($this->commandData->modelName)).'/');
        $this->fileName = 'index.blade.php';
    }

    public function generate()
    {

        $templateData = $this->generatorHelpers->get_template("Views.view");

        $templateData = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $templateData);

        FileUtil::createFile($this->path, $this->fileName, $templateData);

        $this->commandData->commandComment("\nView created: ");
        $this->commandData->commandInfo($this->fileName);
    }

    public function rollback()
    {
        if ($this->rollbackFile($this->path, $this->fileName)) {
            $this->commandData->commandComment('View file deleted: '.$this->fileName);
            File::deleteDirectory($this->path);
        }
    }
}
