<?php

namespace App\Classes\CodeGenerator\Generators\Scaffold;

use App\Classes\CodeGenerator\Common\CommandData;
use App\Classes\CodeGenerator\Generators\BaseGenerator;
use Illuminate\Support\Str;

class RoutesGenerator extends BaseGenerator
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
        $this->path = base_path('routes/crud.php');;
        $this->routeContents = file_get_contents($this->path);
        $this->routesTemplate = $this->generatorHelpers->get_template('Routes.route');
        $this->routesTemplate = $this->generatorHelpers->fill_template($this->commandData->dynamicVars, $this->routesTemplate);
    }

    public function generate()
    {
        if (Str::contains($this->routeContents, "Route::group(['prefix' => '".$this->commandData->config->mSnake."',")) {
            $this->commandData->commandObj->info('Routes for '.$this->commandData->config->mName.' already exists, Skipping Adjustment.');

            return;
        }

        file_put_contents($this->path, $this->routeContents.$this->routesTemplate);
        $this->commandData->commandComment("\n".$this->commandData->config->mName.' routes added.');
    }

    public function rollback()
    {
        if (Str::contains($this->routeContents, $this->routesTemplate)) {
            $this->routeContents = str_replace($this->routesTemplate, '', $this->routeContents);
            file_put_contents($this->path, $this->routeContents);
            $this->commandData->commandComment('Routes deleted');
        }
    }
}
