<?php

namespace App\Classes\CodeGenerator\Common;


use App\Classes\CodeGenerator\Generators\BaseGenerator;
use Illuminate\Support\Str;

class GenerateGetters extends BaseGenerator
{


    public function generate($name, $type){

        $functionPrefix = $type !== 'bool' ? 'get':'';
        $template = $this->generatorHelpers->get_template('Micros.getter_function');

        $template = str_replace('$FIELD_NAME$', str::camel($name), $template);
        $template = str_replace('$DATA_TYPE$', $type, $template);
        $template = str_replace('$FUNCTION_NAME$', $functionPrefix.str::studly($name), $template);

        return $template;
    }


}