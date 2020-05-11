<?php

namespace App\Classes\CodeGenerator\Generators;

use App\Classes\CodeGenerator\Common\GeneratorHelpers;
use App\Classes\CodeGenerator\Utils\FileUtil;

class BaseGenerator
{

    /** @var GeneratorHelpers */
    public $generatorHelpers;

    /**
     * BaseGenerator constructor.
     */
    public function __construct()
    {
        $this->generatorHelpers = new GeneratorHelpers();
    }


    public function rollbackFile($path, $fileName)
    {
        if (file_exists($path.$fileName)) {
            return FileUtil::deleteFile($path, $fileName);
        }

        return false;
    }
}
