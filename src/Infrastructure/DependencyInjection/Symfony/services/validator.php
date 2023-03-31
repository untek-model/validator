<?php

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Untek\Model\Validator\Libs\Validators\ChainValidator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();
    $parameters = $configurator->parameters();

    $services->set(ChainValidator::class, ChainValidator::class)
        ->args(
            [
                service(ContainerInterface::class),
            ]
        );
};