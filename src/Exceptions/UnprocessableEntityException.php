<?php

namespace Untek\Model\Validator\Exceptions;

use Exception;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class UnprocessableEntityException extends Exception
{

    private ConstraintViolationListInterface $violations;

    /**
     * @return ConstraintViolationListInterface|ConstraintViolation[]
     */
    public function getViolations(): ConstraintViolationListInterface|array
    {
        return $this->violations;
    }

    public function setViolations(ConstraintViolationListInterface $violations): self
    {
        $this->violations = $violations;
        return $this;
    }
}
