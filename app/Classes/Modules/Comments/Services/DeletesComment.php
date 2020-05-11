<?php

namespace App\Classes\Modules\Comments\Services;

use App\Classes\General\Eloquent\AbstractDeleteRecord;
use App\Classes\Modules\Comments\DataTransferObjects\CommentObject;
use App\Models\Comment;

class DeletesComment extends AbstractDeleteRecord
{

    public function execute(Comment $model) {
        return $this->handler($model);
    }
}