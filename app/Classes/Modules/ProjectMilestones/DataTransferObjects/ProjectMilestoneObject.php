<?php

namespace App\Classes\Modules\ProjectMilestones\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class ProjectMilestoneObject implements DataTransferObject
{

    /** @var int */
    private $projectId;

    /** @var string */
    private $name;

    /** @var integer */
    private $order;

    /** @var bool */
    private $isComplete;

    /**
     * ProjectMilestoneObject constructor.
     * @param int $projectId
        * @param string $name
        * @param integer $order
        * @param bool $isComplete
     */
    public function __construct(int $projectId, string $name, integer $order, bool $isComplete)
    {
        $this->projectId = $projectId;
        $this->name = $name;
        $this->order = $order;
        $this->isComplete = $isComplete;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return integer
     */
    public function getOrder(): integer
    {
        return $this->order;
    }

    /**
     * @return bool
     */
    public function IsComplete(): bool
    {
        return $this->isComplete;
    }



}