<?php

use Webbala\Application\Bootstrap\DiKeys;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

$container = new ContainerBuilder();

$container->register(DiKeys::GUZZLE, '\GuzzleHttp\Client');

$container
    ->register(DiKeys::FIXER_SERVICE, '\Webbala\Infrastructure\Services\Fixer')
    ->addArgument(new Reference(DiKeys::GUZZLE))
    ->addArgument('https://api.fixer.io/');

$container
    ->register(DiKeys::EXCHANGE_COMMAND, '\Webbala\Application\Commands\ExchangeCommand')
    ->addArgument(new Reference(DiKeys::FIXER_SERVICE));

return $container;
