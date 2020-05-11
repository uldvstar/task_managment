<?php

namespace App\Classes\CodeGenerator\Generators\Micros;


use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Generators\BaseGenerator;
use App\Classes\CodeGenerator\Utils\FileUtil;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ValidatorsGenerator extends BaseGenerator
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
        $this->path = app_path('Classes/Modules/'. str::pluralStudly($this->commandData->modelName).'/Standards/Validators/');
        $this->fileName = Str::studly(Str::singular($this->commandData->modelName)).'Validation.php';
    }

    public function generate()
    {
        $templateData = $this->generatorHelpers->get_template('Validator.request_validation');

        $templateData = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $templateData);

        $templateData = str_replace('$FIELDS$', implode(','.$this->generatorHelpers->generator_nl_tab(1, 3), $this->generateFields()), $templateData);
        $templateData = str_replace('$RULES$', implode(','.$this->generatorHelpers->generator_nl_tab(1, 3), $this->generateRules()), $templateData);

        FileUtil::createFile($this->path, $this->fileName, $templateData);

        $this->commandData->commandComment("\n Request Validator created: ");
        $this->commandData->commandObj->info($this->fileName);

    }

    private function generateRules()
    {
        $dont_require_fields = [];

        $rules = [];

        foreach ($this->commandData->fields as $field) {
            if (!$field->isPrimary && $field->isNotNull && empty($field->validations) &&
                !in_array($field->name, $dont_require_fields)) {
                $field->validations = 'required';
            }

            if (!empty($field->validations)) {
                if (Str::contains($field->validations, 'unique:')) {
                    $rule = explode('|', $field->validations);
                    // move unique rule to last
                    usort($rule, function ($record) {
                        return (Str::contains($record, 'unique:')) ? 1 : 0;
                    });
                    $field->validations = implode('|', $rule);
                }
                $rule = "'".$field->name."' => '".$field->validations."'";
                $rules[] = $rule;
            }
        }

        return $rules;
    }

    private function generateFields()
    {

        $fields = [];

        foreach ($this->commandData->fields as $field) {

            if(!in_array($field->name, $this->commandData->config->excludeFields())) {

                $getterName = $field->dbInput === 'boolean' ? 'is' . str::studly($field->name) : 'get' . str::studly($field->name);

                $field = "'" . $field->name . "' => " . "$" . "object->" . $getterName . "()";
                $fields[] = $field;
            }
        }

        return $fields;
    }

    public function rollback()
    {
        if ($this->rollbackFile($this->path, $this->fileName)) {
            File::deleteDirectory($this->path);
            $this->commandData->commandComment('Request Validation file deleted: '.$this->fileName);
        }

    }
}