<?php

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Untek\Model\Validator\Libs\Validators\ChainValidator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();
    $parameters = $configurator->parameters();

    $services->set(\Symfony\Component\Validator\ValidatorBuilder::class, \Symfony\Component\Validator\ValidatorBuilder::class);
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