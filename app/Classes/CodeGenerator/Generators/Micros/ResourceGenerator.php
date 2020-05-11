<?php

namespace App\Classes\CodeGenerator\Generators\Micros;


use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Generators\BaseGenerator;
use App\Classes\CodeGenerator\Utils\FileUtil;
use Illuminate\Support\Str;

class ResourceGenerator extends BaseGenerator
{

    /** @var CommandData */
    private $commandData;

    /** @var string */
    private $path;

    /** @var string */
    private $fileName;


    /**
     * FactoryGenerator constructor.
     *
     * @param CommandData $commandData
     */
    public function __construct(CommandData $commandData)
    {

        parent::__construct();

        $this->commandData = $commandData;
        $this->path = app_path('Http/Resources/');
        $this->fileName = Str::studly(Str::singular($this->commandData->modelName)).'Resource.php';
    }

    public function generate()
    {
        $templateData = $this->generatorHelpers->get_template('Resource.model_resource');

        $templateData = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $templateData);

        $templateData = str_replace('$FIELDS$', implode(','.$this->generatorHelpers->generator_nl_tab(1, 3), $this->generateFields()), $templateData);

        FileUtil::createFile($this->path, $this->fileName, $templateData);

        $this->commandData->commandComment("\n Resource Object created: ");
        $this->commandData->commandObj->info($this->fileName);

    }


    private function generateFields()
    {

        $fields = [];

        foreach ($this->commandData->fields as $field) {

            $field = "'" . $field->name . "' => " . "$" . "this->" . str::snake($field->name);
            $fields[] = $field;
        }

        return $fields;
    }

    public function rollback()
    {
        if ($this->rollbackFile($this->path, $this->fileName)) {
            $this->commandData->commandComment('Resource Object file deleted: '.$this->fileName);
        }
    }
}