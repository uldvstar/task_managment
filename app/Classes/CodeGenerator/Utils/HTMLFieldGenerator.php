<?php

namespace App\Classes\CodeGenerator\Utils;

use App\Classes\CodeGenerator\Common\GeneratorField;
use App\Classes\CodeGenerator\Common\GeneratorHelpers;
use Illuminate\Support\Str;

class HTMLFieldGenerator
{

    public static function generateHTML(GeneratorField $field)
    {

        $fieldTemplate = '';
        $generatorHelpers = new GeneratorHelpers();

        switch ($field->htmlType) {
            case 'text':
            case 'number':
            case 'checkbox':
                $fieldTemplate = $generatorHelpers->get_template('Fields.text');
                break;
            case 'textarea':
            case 'date':
            case 'file':
            case 'email':
            case 'password':
                $fieldTemplate = $generatorHelpers->get_template('Fields.'.$field->htmlType);
                break;
            case 'select':
            case 'enum':
                $fieldTemplate = $generatorHelpers->get_template('Fields.select');
                $radioLabels = GeneratorFieldsInputUtil::prepareKeyValueArrFromLabelValueStr($field->htmlValues);

                $fieldTemplate = str_replace(
                    '$INPUT_ARR$',
                    GeneratorFieldsInputUtil::prepareKeyValueArrayStr($radioLabels),
                    $fieldTemplate
                );
                break;
            case 'selectTable':
                $inputArr = explode(',', $field->htmlValues[1]);

                $selectTable = $field->htmlValues[0];

                $fieldTemplate = $generatorHelpers->get_template('Fields.selectable');
                $fieldTemplate = str_replace('$SELECT_TABLE$', str::singular($selectTable),$fieldTemplate);
                $fieldTemplate = str_replace('$SELECT_TABLE_CAMEL$', str::singular(str::camel($selectTable)),$fieldTemplate);
                $fieldTemplate = str_replace('$LABEL_COLUMN$',$inputArr[0],$fieldTemplate);
                $fieldTemplate = str_replace('$VALUE_COLUMN$',$inputArr[1],$fieldTemplate);

                break;

            case 'checkbox_2':
                $fieldTemplate = $generatorHelpers->get_template('Fields.checkbox');
                if (count($field->htmlValues) > 0) {
                    $checkboxValue = $field->htmlValues[0];
                } else {
                    $checkboxValue = 1;
                }
                $fieldTemplate = str_replace('$CHECKBOX_VALUE$', $checkboxValue, $fieldTemplate);
                break;
            case 'radio':
                $fieldTemplate = $generatorHelpers->get_template('Fields.radio_group');
                $radioTemplate = $generatorHelpers->get_template('Fields.radio');

                $radioLabels = GeneratorFieldsInputUtil::prepareKeyValueArrFromLabelValueStr($field->htmlValues);

                $radioButtons = [];
                foreach ($radioLabels as $label => $value) {
                    $radioButtonTemplate = str_replace('$LABEL$', $label, $radioTemplate);
                    $radioButtonTemplate = str_replace('$VALUE$', $value, $radioButtonTemplate);
                    $radioButtons[] = $radioButtonTemplate;
                }
                $fieldTemplate = str_replace('$RADIO_BUTTONS$', implode("\n", $radioButtons), $fieldTemplate);
                break;
            case 'toggle-switch':
                $fieldTemplate = $generatorHelpers->get_template('Fields.toggle-switch');
                break;
        }

        return $fieldTemplate;
    }
}
