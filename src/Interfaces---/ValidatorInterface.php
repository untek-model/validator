<?php

namespace Untek\Model\Validator\Interfaces;

\Untek\Core\Code\Helpers\DeprecateHelper::hardThrow();

interface ValidatorInterface
{

    public function validateEntity(object $entity): void;

    public function isMatch(object $entity): bool;

}
