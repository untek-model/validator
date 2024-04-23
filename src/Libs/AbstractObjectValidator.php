<?php

namespace Untek\Model\Validator\Libs;

use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;
use Symfony\Contracts\Translation\TranslatorInterface;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Model\Validator\Exceptions\UnprocessableEntityException;

abstract class AbstractObjectValidator
{

    private ?TranslatorInterface $translator = null;

    public function __construct(?TranslatorInterface $translator = null)
    {
        if($translator == null) {
            // todo: избавиться от этого после внедрения зависимости в валидаторы
            $translator = ContainerHelper::getContainer()->get(TranslatorInterface::class);
        }
        $this->translator = $translator;
    }

    abstract public function getConstraint(): Constraint;

    /**
     * @param object $object
     * @throws UnprocessableEntityException
     */
    public function validate(object $object): void
    {
        $value = $this->getSerializer()->normalize($object);
        $violations = $this->validateObject($value, $this->getConstraint());
        if ($violations->count()) {
            $exception = new UnprocessableEntityException();
            $exception->setViolations($violations);
            throw $exception;
        }
    }

    public function validateAttributes($value): void
    {
        $violations = $this->validateObject($value, $this->getConstraint());
        if ($violations->count()) {
            $exception = new UnprocessableEntityException();
            $exception->setViolations($violations);
            throw $exception;
        }
    }

    protected function validateObject($value, $constraints = null, $groups = null): ConstraintViolationList
    {
        $validator = $this->createValidator();
        if (isset($this->translator)) {
            $contextualValidator = $validator->inContext(new ExecutionContext($validator, $value, $this->translator));
            $contextualValidator->validate($value, $constraints, $groups);
            $violations = $contextualValidator->getViolations();
        } else {
            $violations = $validator->validate($value, $constraints, $groups);
        }
        return $violations;
    }

    private function createValidator(): ValidatorInterface
    {
        $validatorBuilder = new ValidatorBuilder();
        return $validatorBuilder->getValidator();
    }

    protected function getSerializer(): SerializerInterface
    {
        $normalizers = [
            new ArrayDenormalizer(),
            new ObjectNormalizer(),
        ];
        return new Serializer($normalizers);
    }
}