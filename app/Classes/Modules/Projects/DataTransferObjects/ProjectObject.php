<?php

namespace App\Classes\Modules\Projects\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class ProjectObject implements DataTransferObject
{

    /** @var int */
    private $typeId;

    /** @var int */
    private $clientId;

    /** @var string */
    private $reference;

    /** @var string|null */
    private $description;

    /** @var int */
    private $status;

    /**
     * ProjectObject constructor.
     * @param int $typeId
     * @param int $clientId
     * @param string $reference
     * @param null|string $description
     * @param int $status
     */
    public function __construct(int $typeId, int $clientId, string $reference, ?string $description, int $status)
    {
        $this->typeId = $typeId;
        $this->clientId = $clientId;
        $this->reference = $reference;
        $this->description = $description;
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->typeId;
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
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




}