<?php

namespace App\Classes\ValueObjects\Constants;

final class ModularTypes {

    public const CLIENT_MODULE = 1;
    public const PROJECT_MODULE = 2;
    public const TASK_MODULE = 3;
    public const TICKET_MODULE = 4;
    public const DOCUMENT_MODULE = 5;
    public const FIELD_MODULE = 0;

    public const MODULAR_MODULES = [
        'client' => self::CLIENT_MODULE,
        'project' => self::PROJECT_MODULE,
        'task' => self::TASK_MODULE,
        'ticket' => self::TICKET_MODULE,
        'document' => self::DOCUMENT_MODULE,
        'field' => self::FIELD_MODULE,
        'status' => self::STATUS_LIST,
    ];

    public const STATUS_LIST= 21;

}
