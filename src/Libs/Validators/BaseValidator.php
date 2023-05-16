<?php

namespace Untek\Model\Validator\Libs\Validators;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;

class BaseValidator
{

    protected function handleResult(?Enumerable $errorCollection): void
    {
        if ($errorCollection && $errorCollection->count() > 0) {
            $exception = new UnprocessibleEntityException;
            $exception->setErrorCollection($errorCollection);
            throw $exception;
        }
    }
}
