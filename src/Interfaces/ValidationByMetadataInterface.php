<?php

namespace Untek\Model\Validator\Interfaces;

use Symfony\Component\Validator\Mapping\ClassMetadata;

\Untek\Core\Code\Helpers\DeprecateHelper::hardThrow();

interface ValidationByMetadataInterface
{

    public static function loadValidatorMetadata(ClassMetadata $metadata);
}