<?php

namespace App\Classes\General\Abstracts;


use App\Classes\Exceptions\AccessForbiddenException;
use App\Classes\Exceptions\RequestValidationException;
use App\Classes\Interfaces\DataTransferObject;

abstract class AbstractRule
{

    abstract protected function authorized(): bool;

    abstract protected function validators($object): bool;


    abstract protected function criteria($object): bool;


    /**
     * @param DataTransferObject|null $object
     * @return bool
     * @throws AccessForbiddenException
     * @throws RequestValidationException
     */
    public function passes(?DataTransferObject $object = null): bool {
        try {
            if(!$this->authorized()){
                throw new AccessForbiddenException('You don\'t have permission to preform this action');
            }

            $this->validators($object);
            $this->criteria($object);

            return true;

        } catch(AccessForbiddenException $exception){
            throw new AccessForbiddenException('You don\'t have permission to preform this action');
        } catch(\Exception $exception){
            throw new RequestValidationException($exception->getMessage());
        }

    }

}