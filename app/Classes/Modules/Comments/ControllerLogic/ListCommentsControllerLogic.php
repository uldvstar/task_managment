<?php

namespace App\Classes\Modules\Comments\ControllersLogic;


use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Comments\Services\ListsComments;
use App\Classes\Modules\Comments\Standards\Rules\CanListComments;
use App\Http\Resources\CommentResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListCommentsControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'Retrieved Comments',
            'message' => 'You have successfully retrieved a list of Comments'
        ];
    }

    /** @var CanListComments */
    private $canListComments;

    /** @var ListsComments */
    private $listsComments;

    /**
     * ListCommentsControllerLogic constructor.
     * @param CanListComments $canListComments
     * @param ListsComments $listsComments
     */
    public function __construct(CanListComments $canListComments, ListsComments $listsComments)
    {
        $this->canListComments = $canListComments;
        $this->listsComments = $listsComments;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {

            $this->canListComments->passes();

            $query = $this->listsComments->execute($this->listsComments->deserializeFilters($request->input('filters')));

            return $this->collectionResponse(CommentResource::collection($query));

        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }

}