<?php

namespace App\Classes\Modules\Clients\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class ClientObject implements DataTransferObject
{

    /** @var int */
    private $typeId;

    /** @var string */
    private $marking;

    /** @var string */
    private $name;

    /** @var string */
    private $email;

    /** @var string|null */
    private $wechatId;

    /**
     * ClientObject constructor.
     * @param int $typeId
     * @param string $marking
     * @param string $name
     * @param string $email
     * @param null|string $wechatId
     */
    public function __construct(int $typeId, string $marking, string $name, string $email, ?string $wechatId)
    {
        $this->typeId = $typeId;
        $this->marking = $marking;
        $this->name = $name;
        $this->email = $email;
        $this->wechatId = $wechatId;
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
    public function getMarking(): string
    {
        return $this->marking;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return null|string
     */
    public function getWechatId(): ?string
    {
        return $this->wechatId;
    }

}