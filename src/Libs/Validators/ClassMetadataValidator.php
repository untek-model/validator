<?php

namespace Untek\Model\Validator\Libs\Validators;

use Untek\Model\Validator\Helpers\SymfonyValidationHelper;
use Untek\Model\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Model\Validator\Interfaces\ValidatorInterface;

class ClassMetadataValidator extends BaseValidator implements ValidatorInterface
{

    public function validateEntity(object $entity): void
    {
        $errorCollection = SymfonyValidationHelper::validate($entity);
        $this->handleResult($errorCollection);
    }

    public function isMatch(object $entity): bool
    {
        return $entity instanceof ValidationByMetadataInterface;
    }
}
