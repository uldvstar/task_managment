<?php

namespace App\Classes\Modules\Accounts\ControllerLogic;

use App\Classes\General\Abstracts\AbstractControllerLogic;
use App\Classes\Modules\Accounts\Services\ListsUsers;
use App\Classes\Modules\Accounts\Standards\Rules\CanListUsers;
use App\Http\Resources\UserResource;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListUsersControllerLogic extends AbstractControllerLogic
{

    /**
     * @return array
     */
    protected function notification():array {
        return [
            'title' => 'List Users',
            'message' => 'You have successfully retrieved a list of users'
        ];
    }

    /** @var CanListUsers */
    private $canListUser;

    /** @var ListsUsers */
    private $listsUsers;

    /**
     * ListUsersControllerLogic constructor.
     * @param CanListUsers $canListUser
     * @param ListsUsers $listsUsers
     */
    public function __construct(CanListUsers $canListUser, ListsUsers $listsUsers)
    {
        $this->canListUser = $canListUser;
        $this->listsUsers = $listsUsers;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorException
     */
    public function logic(Request $request) : JsonResponse
    {
        try {



            $this->canListUser->passes();

            $query = $this->listsUsers->execute($this->listsUsers->deserializeFilters($request->input('filters')));

            return $this->collectionResponse(UserResource::collection($query));


        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }

    }



}