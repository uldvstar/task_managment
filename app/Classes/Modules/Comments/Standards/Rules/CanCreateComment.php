<?php

namespace App\Classes\Modules\Comments\Standards\Rules;


use App\Classes\General\Abstracts\AbstractRule;
use App\Classes\Modules\Comments\DataTransferObjects\CommentObject;
use App\Classes\Modules\Comments\Standards\Validators\CommentValidation;

class CanCreateComment extends AbstractRule
{

    /** @var CommentValidation */
    private $commentValidation;

    /**
     * CanCreateComment constructor.
     * @param CommentValidation $commentValidation
     */
    public function __construct(CommentValidation $commentValidation)
    {
        $this->commentValidation = $commentValidation;
    }


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
     * @throws \App\Classes\Exceptions\RequestValidationException
     */
    protected function validators($object): bool
    {
        return $this->commentValidation->validate($object);

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