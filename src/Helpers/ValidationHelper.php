<?php

namespace Untek\Model\Validator\Helpers;

use Symfony\Component\Validator\ConstraintViolationList;
use Untek\Core\Code\Helpers\DeprecateHelper;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Model\Validator\Entities\ValidationErrorEntity;
use Untek\Model\Validator\Libs\Validators\ChainValidator;

\Untek\Core\Code\Helpers\DeprecateHelper::hardThrow();

class ValidationHelper
{

    public static function validateEntity(object $entity): void
    {
        DeprecateHelper::hardThrow();
        $container = ContainerHelper::getContainer();
        $validator = $container->get(ChainValidator::class);
        $validator->validateEntity($entity);
    }

    /**
     * @return array | \Untek\Core\Collection\Interfaces\Enumerable | ValidationErrorEntity[]
     */
    public static function validateValue($value, array $rules): ConstraintViolationList
    {
        DeprecateHelper::hardThrow();
        $validator = SymfonyValidationHelper::createValidator();
        $violations = $validator->validate($value, $rules);
        return $violations;
    }
}
