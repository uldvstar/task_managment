<?php

namespace App\Classes\Modules\Comments\DataTransferObjects;

use App\Classes\Interfaces\DataTransferObject;

class CommentObject implements DataTransferObject
{

    /** @var int */
    private $commentableId;

    /** @var string */
    private $commentableType;

    /** @var int */
    private $userId;

    /** @var string */
    private $comment;

    /**
     * CommentObject constructor.
     * @param int $commentableId
     * @param string $commentableType
     * @param int $userId
     * @param string $comment
     */
    public function __construct(int $commentableId, string $commentableType, int $userId, string $comment)
    {
        $this->commentableId = $commentableId;
        $this->commentableType = $commentableType;
        $this->userId = $userId;
        $this->comment = $comment;
    }

    /**
     * @return int
     */
    public function getCommentableId(): int
    {
        return $this->commentableId;
    }

    /**
     * @return string
     */
    public function getCommentableType(): string
    {
        return 'App\Models\\'.$this->commentableType;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

}