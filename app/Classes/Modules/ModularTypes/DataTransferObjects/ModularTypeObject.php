<?php

namespace App\Classes\Modules\ModularTypes\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class ModularTypeObject implements DataTransferObject
{

    /** @var int */
    private $moduleType;

    /** @var string */
    private $name;

    /** @var string|null */
    private $reference;

    /** @var string|null */
    private $description;

    /**
     * ModularTypeObject constructor.
     * @param int $moduleType
     * @param string $name
     * @param null|string $reference
     * @param null|string $description
     */
    public function __construct(int $moduleType, string $name, ?string $reference, ?string $description)
    {
        $this->moduleType = $moduleType;
        $this->name = $name;
        $this->reference = $reference;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getModuleType(): int
    {
        return $this->moduleType;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getReference(): ?string
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



}