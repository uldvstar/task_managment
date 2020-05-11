<?php

namespace App\Classes\CodeGenerator\Generators\Micros;


use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Common\GenerateGetters;
use App\Classes\CodeGenerator\Generators\BaseGenerator;
use App\Classes\CodeGenerator\Utils\FileUtil;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DataTransferObjectGenerator extends BaseGenerator
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
        $this->path = app_path('Classes/Modules/'. str::pluralStudly($this->commandData->modelName).'/DataTransferObjects/');
        $this->fileName = Str::studly(Str::singular($this->commandData->modelName)).'Object.php';
    }

    public function generate()
    {

        $templateData = $this->generatorHelpers->get_template('Micros.data_transfer_object');

        $templateData = $this->fillTemplate($templateData);

        FileUtil::createFile($this->path, $this->fileName, $templateData);

        $this->commandData->commandComment("\nDataTransferObject created: ");
        $this->commandData->commandObj->info($this->fileName);

    }

    /**
     * @param string $templateData
     *
     * @return mixed|string
     */
    private function fillTemplate($templateData)
    {
        $properties = [];
        $docs = [];
        $injection = [];
        $body = [];
        $getters = [];

        foreach ($this->commandData->fields as $field) {
            if(!in_array($field->name, $this->commandData->config->excludeFields())){
                $docType = $this->getPHPDocType($field->fieldType);
                $fieldName = $docType === 'bool' ? 'is'.str::studly($field->name) : str::camel($field->name);
                $properties[] = '/** @var '.$docType.' */'.PHP_EOL.$this->generatorHelpers->generator_nl_tab(0, 1).'private $'.str::camel($fieldName).';';
                $docs[] = '* @param '.$docType.' $'.str::camel($fieldName);
                $injection[] = $docType.' $'.str::camel($fieldName);
                $body[] = '$this->'.str::camel($fieldName).' = $'.str::camel($fieldName).';';
                $getters[] = (new GenerateGetters())->generate($fieldName, $docType);
            }

        }

        $templateData = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $templateData);

        $templateData = str_replace(
            '$PROPERTIES$',
            implode(PHP_EOL.$this->generatorHelpers->generator_nl_tab(1, 1), $properties),
            $templateData
        );

        $templateData = str_replace(
            '$CONSTRUCTOR_DOCS$',
            implode($this->generatorHelpers->generator_nl_tab(1, 2), $docs),
            $templateData
        );

        $templateData = str_replace(
            '$CONSTRUCTOR_PROPERTIES$',
            implode(', ', $injection),
            $templateData
        );

        $templateData = str_replace(
            '$CONSTRUCTOR_BODY$',
            implode($this->generatorHelpers->generator_nl_tab(1, 2), $body),
            $templateData
        );

        $templateData = str_replace(
            '$GETTER_FUNCTIONS$',
            implode($this->generatorHelpers->generator_nl_tab(1, 0), $getters),
            $templateData
        );

        return $templateData;
    }



    private function getPHPDocType($db_type){
        switch ($db_type) {
            case 'text':
                return 'string';
            case 'datetime':
                return '\Carbon\Carbon';
            case 'boolean':
                return 'bool';
            default:
                return $db_type;

        }
    }

    public function rollback()
    {
        if ($this->rollbackFile($this->path, $this->fileName)) {
            File::deleteDirectory($this->path);
            $this->commandData->commandComment('DataTransferObject file deleted: '.$this->fileName);
        }
    }

}