<?php

namespace App\Classes\Modules\MilestoneTasks\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class MilestoneTaskObject implements DataTransferObject
{

    /** @var int */
    private $milestoneId;

    /** @var int */
    private $typeId;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /**
     * MilestoneTaskObject constructor.
     * @param int $milestoneId
        * @param int $typeId
        * @param string $title
        * @param string $description
     */
    public function __construct(int $milestoneId, int $typeId, string $title, string $description)
    {
        $this->milestoneId = $milestoneId;
        $this->typeId = $typeId;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getMilestoneId(): int
    {
        return $this->milestoneId;
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->typeId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }



}