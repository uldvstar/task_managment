<?php

namespace App\Classes\CodeGenerator\Generators\Scaffold;

use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Generators\BaseGenerator;
use Illuminate\Support\Str;

class WebRouteGenerator extends BaseGenerator
{
    /** @var CommandData */
    private $commandData;

    /** @var string */
    private $path;

    /** @var string */
    private $routeContents;

    /** @var string */
    private $routesTemplate;

    public function __construct(CommandData $commandData)
    {

        parent::__construct();

        $this->commandData = $commandData;
        $this->path = base_path('routes/web.php');;
        $this->routeContents = file_get_contents($this->path);
        $this->routesTemplate = $this->generatorHelpers->get_template('Routes.web');
        $this->routesTemplate = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $this->routesTemplate);
    }

    public function generate()
    {
        if (Str::contains($this->routeContents, "Route::get('/".$this->commandData->config->mSnakePlural."'")) {
            $this->commandData->commandObj->info('Web route for '.$this->commandData->config->mName.' already exists, Skipping Adjustment.');

            return;
        }

        file_put_contents($this->path, $this->routeContents.$this->routesTemplate);
        $this->commandData->commandComment("\n".$this->commandData->config->mName.' web route added.');
    }

    public function rollback()
    {
        if (Str::contains($this->routeContents, $this->routesTemplate)) {
            $this->routeContents = str_replace($this->routesTemplate, '', $this->routeContents);
            file_put_contents($this->path, $this->routeContents);
            $this->commandData->commandComment('web route deleted');
        }
    }
}
