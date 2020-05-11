<?php

namespace App\Classes\Modules\Comments\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Comments\Services\UpdatesComment;
use App\Classes\Modules\Comments\Services\FetchesComment;
use App\Classes\Modules\Comments\Standards\Rules\CanUpdateComment;
use App\Classes\Modules\Comments\DataTransferObjects\CommentObject;
use App\Http\Resources\CommentResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateCommentControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Updated Comment',
            'message' => 'You have successfully updated the Comment'
        ];
    }

    /** @var CanUpdateComment */
    private $canUpdateComment;

    /** @var UpdatesComment */
    private $updatesComment;

    /** @var FetchesComment */
    private $fetchesComment;

    /**
     * UpdateCommentControllerLogic constructor.
     * @param CanUpdateComment $canUpdateComment
     * @param UpdatesComment $updatesComment
     * @param FetchesComment $fetchesComment
     */
    public function __construct(CanUpdateComment $canUpdateComment, UpdatesComment $updatesComment, FetchesComment $fetchesComment)
    {
        $this->canUpdateComment = $canUpdateComment;
        $this->updatesComment = $updatesComment;
        $this->fetchesComment = $fetchesComment;
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

            $this->canUpdateComment->passes($object);

            $query = $this->fetchesComment->execute(['id' => $request->route('id')]);

            $query = $this->updatesComment->execute($query, $object);

            return $this->resourceResponse(new CommentResource($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}