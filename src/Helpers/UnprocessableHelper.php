<?php

namespace Untek\Model\Validator\Helpers;

use Untek\Core\Collection\Libs\Collection;
use Untek\Model\Validator\Entities\ValidationErrorEntity;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;

class UnprocessableHelper
{

    public static function throwItem(string $field, string $mesage): void
    {
        $errorCollection = new Collection();
        $validationErrorEntity = new ValidationErrorEntity($field, $mesage);
        $errorCollection->add($validationErrorEntity);
        throw new UnprocessibleEntityException($errorCollection);
    }

    public static function throwItems(array $errorArray): void
    {
        $errorCollection = ErrorCollectionHelper::flatArrayToCollection($errorArray);
        throw new UnprocessibleEntityException($errorCollection);
    }
}
