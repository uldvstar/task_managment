<?php

namespace App\Classes\Modules\Comments\Standards\Validators;


use App\Classes\General\Abstracts\AbstractValidation;
use App\Classes\Modules\Comments\DataTransferObjects\CommentObject;

class CommentValidation extends AbstractValidation
{


    /**
     * @param CommentObject $object
     * @return array
     */
    protected function data($object): array {
        return [
            'commentable_id' => $object->getCommentableId(),
            'commentable_type' => $object->getCommentableType(),
            'user_id' => $object->getUserId(),
            'comment' => $object->getComment()
        ];
    }

    /**
     * @return array
     */
    protected function rules(): array {
        return [
            
        ];
    }

    /**
     * @return array
     */
    protected function messages(): array {
        return [];
    }

}