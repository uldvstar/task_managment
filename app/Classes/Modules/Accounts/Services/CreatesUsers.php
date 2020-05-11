<?php

namespace App\Classes\Modules\Accounts\Services;


use App\Classes\General\Eloquent\AbstractListRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class CreatesUsers extends AbstractListRecord
{

    /** @var User */
    private $repository;

    /**
     * ListsUsers constructor.
     * @param User $repository
     */
    public function __construct(User $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @return Builder
     */
    function getRepository(): Builder
    {
        return $this->repository->newQuery();
    }

    public function execute($object) {
        $model = new User();

        return $this->handler($model, $object);

    }

    public function handler($model, $object){
        try{

            if($model->save()){
                return $model;
            }

        } catch (QueryException $exception){
            throw new MalformedRequestException('Unable to create the record due to unexpected error');
        }
    }
}