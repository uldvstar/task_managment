<?php

namespace App\Classes\Modules\Comments\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Comments\Services\DeletesComment;
use App\Classes\Modules\Comments\Services\FetchesComment;
use App\Classes\Modules\Comments\Standards\Rules\CanDeleteComment;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteCommentControllerLogic extends AbstractControllerLogic
{
    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Deleted Comment',
            'message' => 'You have successfully deleted a Comment'
        ];
    }


    /** @var CanDeleteComment */
    private $canDeleteComment;

    /** @var DeletesComment */
    private $deletesComment;

    /** @var FetchesComment */
        private $fetchesComment;

    /**
     * DeleteCommentControllerLogic constructor.
     * @param CanDeleteComment $canDeleteComment
     * @param DeletesComment $deletesComment
     * @param FetchesComment $fetchesComment
     */
    public function __construct(CanDeleteComment $canDeleteComment, DeletesComment $deletesComment, FetchesComment $fetchesComment)
    {
        $this->canDeleteComment = $canDeleteComment;
        $this->deletesComment = $deletesComment;
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

            $this->canDeleteComment->passes();

            $query = $this->fetchesComment->execute(['id' => $request->route('id')]);

            $this->deletesComment->execute($query);

            return $this->response([]);

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}