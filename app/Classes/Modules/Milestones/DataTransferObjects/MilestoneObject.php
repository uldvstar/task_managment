<?php

namespace App\Classes\Modules\Milestones\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class MilestoneObject implements DataTransferObject
{

    /** @var int */
    private $projectType;

    /** @var string */
    private $name;

    /**
     * MilestoneObject constructor.
     * @param int $projectType
     * @param string $name
     */
    public function __construct(int $projectType, string $name)
    {
        $this->projectType = $projectType;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getProjectType(): int
    {
        return $this->projectType;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }




}