<?php

namespace App\Classes\Modules\Comments\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Comments\DataTransferObjects\CommentObject;

class CanDeleteComment extends AbstractRule
{


    /**
     * @return bool
     */
    protected function authorized(): bool
    {
        // TODO  Set Authorization rules
        return true;

    }

    /**
     * @param CommentObject $object
     * @return bool
     */
    protected function validators($object): bool
    {
        return true;

    }


    /**
     * @param CommentObject $object
     * @return bool
     */
    protected function criteria($object): bool
    {
        return true;
    }

}