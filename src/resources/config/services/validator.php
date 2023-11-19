<?php

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Untek\Model\Validator\Libs\Validators\ChainValidator;
use Symfony\Component\Validator\ValidatorBuilder;
use Untek\Model\Validator\Interfaces\ValidatorInterface;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();
    $parameters = $configurator->parameters();

    $services->set(ValidatorBuilder::class, ValidatorBuilder::class);
    $services->alias(ValidatorInterface::class, ChainValidator::class);
    $services->set(ChainValidator::class, ChainValidator::class)
        ->args(
            [
                service(ContainerInterface::class),
            ]
        )
        ->call(
            'setValidators',
            [
                [
                    \Untek\Model\Validator\Libs\Validators\ClassMetadataValidator::class,
//                \Untek\Lib\Components\DynamicEntity\Libs\Validators\DynamicEntityValidator::class,
                ],
            ]
        );
};