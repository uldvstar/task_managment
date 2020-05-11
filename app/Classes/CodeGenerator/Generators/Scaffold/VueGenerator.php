<?php

namespace App\Classes\CodeGenerator\Generators\Scaffold;

use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Generators\BaseGenerator;
use App\Classes\CodeGenerator\Utils\FileUtil;
use App\Classes\CodeGenerator\Utils\HTMLFieldGenerator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class VueGenerator extends BaseGenerator
{
    /** @var CommandData */
    private $commandData;

    /** @var string */
    private $path;

    /** @var array */
    private $htmlFields;



    public function __construct(CommandData $commandData)
    {

        parent::__construct();

        $this->commandData = $commandData;
        $this->path = resource_path('assets/vue/components/'.str::camel($this->commandData->modelName).'/');

    }

    public function generate()
    {

        $fields = [];
        $i = 1;
        foreach ($this->commandData->fields as $index => $field) {
            if (!$field->inIndex) {
                continue;
            }

            $fieldTemplate = $this->generatorHelpers->get_template("Views.column");
            $fieldTemplate = str_replace('$FIRST_COLUMN_CLASS$', $i === 1 ? 'ist-item-heading truncate' : 'text-small', $fieldTemplate);
            $fieldTemplate = str_replace('$COLUMN_SIZE$', $i === 1 ? 'col-3' : 'col', $fieldTemplate);
            $fieldTemplate = $this->generatorHelpers->fill_template_with_field_data(
                $this->commandData->dynamicVars,
                $this->commandData->fieldNamesMapping,
                $fieldTemplate,
                $field
            );

            $fields[] = $fieldTemplate;

            $i++;

        }
        $templateData = $this->generatorHelpers->get_template("VueJs.element_component");
        $templateData = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $templateData);
        $templateData = str_replace('$FIELD_BODY$', implode($this->generatorHelpers->generator_nl_tab(1, 0), $fields), $templateData);
        $fileName = $this->commandData->modelName.'Component.vue';
        FileUtil::createFile($this->path.'elements/', $fileName, $templateData);

        $this->commandData->commandComment("\nvue element  created: ");
        $this->commandData->commandInfo($fileName);

        $this->generateForm();
        $this->generateFilterForm();
    }

    private function generateForm()
    {

        $this->htmlFields = [];
        $formFields = [];
        $validations = [];

        foreach ($this->commandData->fields as $field) {
            if (!$field->inForm) {
                continue;
            }

            $formFields[] = $field->name.": ''";

            $validations[] = $field->name . ": { " . implode(', ', explode('|', $field->validations)) ." }";

            $fieldTemplate = $this->generatorHelpers->get_template('Fields.field');

            $fieldInputTemplate =  HTMLFieldGenerator::generateHTML($field);

            if($field->htmlType === 'selectTable'){
                $fieldTemplate =  str_replace('$v.parameters.$FIELD_NAME$', '$v.parameters.'.$field->name, $fieldTemplate);
                $fieldTemplate =  str_replace('$FIELD_NAME$', Str::replaceLast('_id', '', $field->name), $fieldTemplate);
            }

            $fieldTemplate =  str_replace('$FIELD$', $fieldInputTemplate, $fieldTemplate);


            if (!empty($fieldTemplate)) {
                $fieldTemplate = $this->generatorHelpers->fill_template_with_field_data(
                    $this->commandData->dynamicVars,
                    $this->commandData->fieldNamesMapping,
                    $fieldTemplate,
                    $field
                );

                $this->htmlFields[] = $fieldTemplate;
            }
        }

        $templateData = $this->generatorHelpers->get_template('VueJs.form_component');
        $templateData = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $templateData);

        $templateData = str_replace('$FIELDS$', implode("\n", $this->htmlFields), $templateData);
        $templateData = str_replace('$REQUEST_FIELDS$', implode(','.$this->generatorHelpers->generator_nl_tab(1, 5), $formFields), $templateData);
        $templateData = str_replace('$VALIDATION$', implode(','.$this->generatorHelpers->generator_nl_tab(1, 4), $validations), $templateData);

        FileUtil::createFile($this->path.'forms/', $this->commandData->modelName.'FormComponent.vue', $templateData);
        $this->commandData->commandComment("\nvue form created: ");
        $this->commandData->commandInfo($this->commandData->modelName.'FormComponent.vue');
    }

    private function generateFilterForm()
    {

        $filterFields = [];
        $filterMap = [];

        foreach ($this->commandData->fields as $field) {
            if (!$field->isSearchable) {
                continue;
            }


            $filterMap[] = $field->name.": ''";

            $fieldTemplate = $this->generatorHelpers->get_template('Fields.filter_field');

            $fieldInputTemplate =  HTMLFieldGenerator::generateHTML($field);

            if($field->htmlType === 'selectTable'){
                $fieldTemplate =  str_replace('$v.parameters.$FIELD_NAME$', '$v.parameters.'.$field->name, $fieldTemplate);
                $fieldTemplate =  str_replace('$FIELD_NAME$', Str::replaceLast('_id', '', $field->name), $fieldTemplate);
            }

            $fieldTemplate =  str_replace('$FIELD$', $fieldInputTemplate, $fieldTemplate);


            if (!empty($fieldTemplate)) {
                $fieldTemplate = $this->generatorHelpers->fill_template_with_field_data(
                    $this->commandData->dynamicVars,
                    $this->commandData->fieldNamesMapping,
                    $fieldTemplate,
                    $field
                );

                $filterFields[] = $fieldTemplate;
            }
        }

        $templateData = $this->generatorHelpers->get_template('VueJs.filter_component');
        $templateData = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $templateData);

        $templateData = str_replace('$FIELDS$', implode("\n", $filterFields), $templateData);
        $templateData = str_replace('$REQUEST_FIELDS$', implode(','.$this->generatorHelpers->generator_nl_tab(1, 5), $filterMap), $templateData);

        FileUtil::createFile($this->path.'forms/', $this->commandData->modelName.'FiltersComponent.vue', $templateData);
        $this->commandData->commandComment("\nvue filter created: ");
        $this->commandData->commandInfo($this->commandData->modelName.'FiltersComponent.vue');
    }



    public function rollback()
    {
        foreach(['elements', 'forms'] as $folderType){
            if($folderType === 'elements'){
                if ($this->rollbackFile($this->path.$folderType.'/', $this->commandData->modelName.'Component.vue')) {
                    $this->commandData->commandComment('Vue element file deleted: '.$this->commandData->modelName.'Component.vue');
                }
            } else {
                foreach(['form', 'filter'] as $type){
                    if ($this->rollbackFile($this->path.$folderType.'/', $this->commandData->modelName.str::studly($type).'Component.vue')) {
                        $this->commandData->commandComment('Vue '.$type.' file deleted: '.$this->commandData->modelName.str::studly($type).'Component.vue');
                    }
                }

            }
            File::deleteDirectory($this->path.$folderType.'/');
        }

        File::deleteDirectory($this->path);
    }
}
