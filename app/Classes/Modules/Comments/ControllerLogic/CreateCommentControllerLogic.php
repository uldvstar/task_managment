<?php

namespace App\Classes\Modules\Comments\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Comments\Services\CreatesComment;
use App\Classes\Modules\Comments\Standards\Rules\CanCreateComment;
use App\Classes\Modules\Comments\DataTransferObjects\CommentObject;
use App\Http\Resources\CommentResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateCommentControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Created Comment',
            'message' => 'You have successfully created a new Comment'
        ];
    }

    /** @var CanCreateComment */
    private $canCreateComment;

    /** @var CreatesComment */
    private $createsComment;

    /**
     * CreateCommentControllerLogic constructor.
     * @param CanCreateComment $canCreateComment
     * @param CreatesComment $createsComment
     */
    public function __construct(CanCreateComment $canCreateComment, CreatesComment $createsComment)
    {
        $this->canCreateComment = $canCreateComment;
        $this->createsComment = $createsComment;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $object = new CommentObject($request->input('commentable_id'), $request->input('commentable_type'), Auth::user()->getAuthIdentifier(), $request->input('comment'));

            $this->canCreateComment->passes($object);

            $query = $this->createsComment->execute($object);

            return $this->response();

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}