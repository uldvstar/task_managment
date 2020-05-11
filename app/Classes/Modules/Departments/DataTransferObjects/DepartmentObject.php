<?php

namespace App\Classes\Modules\Departments\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class DepartmentObject implements DataTransferObject
{

    /** @var string */
    private $name;

    /** @var string|null */
    private $description;

    /** @var int|null */
    private $headId;

    /**
     * DepartmentObject constructor.
     * @param string $name
     * @param null|string $description
     * @param int|null $headId
     */
    public function __construct(string $name, ?string $description, ?int $headId)
    {
        $this->name = $name;
        $this->description = $description;
        $this->headId = $headId;
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getHeadId(): ?int
    {
        return $this->headId;
    }

}