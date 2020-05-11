<?php

namespace App\Classes\CodeGenerator\Common;

use Illuminate\Support\Str;

class GeneratorHelpers
{

    public function generator_tab($spaces = 4)
    {
        return str_repeat(' ', $spaces);
    }

    public function generator_tabs($tabs, $spaces = 4)
    {
        return str_repeat($this->generator_tab($spaces), $tabs);
    }

    public function generator_nl($count = 1)
    {
        return str_repeat(PHP_EOL, $count);
    }

    public function generator_nls($count, $nls = 1)
    {
        return str_repeat($this->generator_nl($nls), $count);
    }

    public function generator_nl_tab($lns = 1, $tabs = 1)
    {
        return $this->generator_nl($lns) . $this->generator_tabs($tabs);
    }

    public function get_template_file_path($templateName)
    {
        $templateName = str_replace('.', '/', $templateName);

        return base_path('App/Classes/CodeGenerator/Stubs/'.$templateName.'.stub');
    }

    public function get_template($templateName)
    {
        $path = $this->get_template_file_path($templateName);

        return file_get_contents($path);
    }

    public function fill_template($variables, $template)
    {
        foreach ($variables as $variable => $value) {
            $template = str_replace($variable, $value, $template);
        }

        return $template;
    }

    public function fill_field_template($variables, $template, $field)
    {
        foreach ($variables as $variable => $key) {
            $template = str_replace($variable, $field->$key, $template);
        }

        return $template;
    }

    public function fill_template_with_field_data($variables, $fieldVariables, $template, $field)
    {
        $template = $this->fill_template($variables, $template);

        return $this->fill_field_template($fieldVariables, $template, $field);
    }

    public function model_name_from_table_name($tableName)
    {
        return Str::ucfirst(Str::camel(Str::singular($tableName)));
    }
}