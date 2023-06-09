<?php

namespace Untek\Model\Validator\Interfaces;

use Symfony\Component\Validator\Mapping\ClassMetadata;

interface ValidationByMetadataInterface
{

    public static function loadValidatorMetadata(ClassMetadata $metadata);
}