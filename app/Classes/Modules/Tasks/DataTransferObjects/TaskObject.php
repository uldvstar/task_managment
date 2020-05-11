<?php

namespace App\Classes\Modules\Tasks\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class TaskObject implements DataTransferObject
{

    /** @var int */
    private $milestoneId;

    /** @var int */
    private $typeId;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var int */
    private $status;

    /** @var bool */
    private $isActive;

    /**
     * TaskObject constructor.
     * @param int $milestoneId
        * @param int $typeId
        * @param string $title
        * @param string $description
        * @param int $status
        * @param bool $isActive
     */
    public function __construct(int $milestoneId, int $typeId, string $title, string $description, int $status, bool $isActive)
    {
        $this->milestoneId = $milestoneId;
        $this->typeId = $typeId;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->isActive = $isActive;
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

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function IsActive(): bool
    {
        return $this->isActive;
    }



}