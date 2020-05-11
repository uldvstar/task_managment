<?php

namespace App\Classes\Modules\Comments\Services;

use App\Classes\General\Eloquent\AbstractUpdateRecord;
use App\Classes\Modules\Comments\DataTransferObjects\CommentObject;
use App\Models\Comment;

class UpdatesComment extends AbstractUpdateRecord
{

    public function execute(Comment $model, CommentObject $object) {

        $model->commentable_id = $object->getCommentableId();
        $model->commentable_type = $object->getCommentableType();
        $model->user_id = $object->getUserId();
        $model->comment = $object->getComment();

        return $this->handler($model);

    }
}