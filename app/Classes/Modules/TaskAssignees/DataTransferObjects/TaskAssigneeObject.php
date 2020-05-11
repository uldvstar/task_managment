<?php

namespace App\Classes\Modules\TaskAssignees\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class TaskAssigneeObject implements DataTransferObject
{

    /** @var int */
    private $assigneeId;

    /** @var string */
    private $assigneeType;

    /** @var int */
    private $assignmentId;

    /**
     * MilestoneTaskAssigneeObject constructor.
     * @param int $assigneeId
     * @param string $assigneeType
     * @param int $assignmentId
     */
    public function __construct(int $assigneeId, string $assigneeType, int $assignmentId)
    {
        $this->assigneeId = $assigneeId;
        $this->assigneeType = $assigneeType;
        $this->assignmentId = $assignmentId;
    }

    /**
     * @return int
     */
    public function getAssigneeId(): int
    {
        return $this->assigneeId;
    }

    /**
     * @return string
     */
    public function getAssigneeType(): string
    {
        return 'App\Models\\'.$this->assigneeType;
    }

    /**
     * @return int
     */
    public function getAssignmentId(): int
    {
        return $this->assignmentId;
    }



}