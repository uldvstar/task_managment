<?php

namespace App\Classes\Modules\Comments\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Comments\Services\FetchesComment;
use App\Classes\Modules\Comments\Standards\Rules\CanFetchComment;
use App\Classes\Modules\Comments\DataTransferObjects\CommentObject;
use App\Http\Resources\CommentResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchCommentControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Comment',
            'message' => 'You have successfully retrieved a Comment'
        ];
    }

    /** @var CanFetchComment */
    private $canFetchComment;

    /** @var FetchesComment */
    private $fetchesComment;

    /**
     * FetchCommentControllerLogic constructor.
     * @param CanFetchComment $canFetchComment
     * @param FetchesComment $fetchesComment
     */
    public function __construct(CanFetchComment $canFetchComment, FetchesComment $fetchesComment)
    {
        $this->canFetchComment = $canFetchComment;
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

            $this->canFetchComment->passes();

            $query = $this->fetchesComment->execute(['id' => $request->route('id')]);

            return $this->resourceResponse(new CommentResource($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}