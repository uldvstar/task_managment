<?php

namespace App\Classes\Modules\TimeTrackers\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class TimeTrackerObject implements DataTransferObject
{

    /** @var int */
    private $trackableId;

    /** @var string */
    private $trackableType;

    /** @var int */
    private $userId;

    /** @var \Carbon\Carbon */
    private $timeStart;

    /** @var \Carbon\Carbon */
    private $timeEnd;

    /**
     * TimeTrackerObject constructor.
     * @param int $trackableId
        * @param string $trackableType
        * @param int $userId
        * @param \Carbon\Carbon $timeStart
        * @param \Carbon\Carbon $timeEnd
     */
    public function __construct(int $trackableId, string $trackableType, int $userId, \Carbon\Carbon $timeStart, \Carbon\Carbon $timeEnd)
    {
        $this->trackableId = $trackableId;
        $this->trackableType = $trackableType;
        $this->userId = $userId;
        $this->timeStart = $timeStart;
        $this->timeEnd = $timeEnd;
    }

    /**
     * @return int
     */
    public function getTrackableId(): int
    {
        return $this->trackableId;
    }

    /**
     * @return string
     */
    public function getTrackableType(): string
    {
        return $this->trackableType;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getTimeStart(): \Carbon\Carbon
    {
        return $this->timeStart;
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getTimeEnd(): \Carbon\Carbon
    {
        return $this->timeEnd;
    }



}