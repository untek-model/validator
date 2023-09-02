<?php

namespace Untek\Model\Validator\Libs;

use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;
use Untek\Model\Validator\Exceptions\UnprocessableEntityException;

abstract class AbstractObjectValidator
{

    abstract public function getConstraint(): Constraint;

    /**
     * @param object $object
     * @throws UnprocessableEntityException
     */
    public function validate(object $object): void
    {
        $validator = $this->createValidator();
        $serializer = $this->getSerializer();
        $array = $serializer->normalize($object);
        $constraints = $this->getConstraint();
        $violations = $validator->validate($array, $constraints);
        if ($violations->count()) {
            $exception = new UnprocessableEntityException();
            $exception->setViolations($violations);
            throw $exception;
        }
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