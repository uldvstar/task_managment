<?php

namespace App\Classes\Modules\Comments\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\Comments\DataTransferObjects\CommentObject;
use App\Models\Comment;

class CreatesComment extends AbstractUpdateRecord
{

    public function execute(CommentObject $object) {
        $model = new Comment();
        $model->commentable_id = $object->getCommentableId();
        $model->commentable_type = $object->getCommentableType();
        $model->user_id = $object->getUserId();
        $model->comment = $object->getComment();

        return $this->handler($model);

    }
}