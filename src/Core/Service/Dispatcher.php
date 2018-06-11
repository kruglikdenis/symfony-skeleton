<?php

namespace App\Core\Service;


use Broadway\CommandHandling\CommandBus;

class Dispatcher
{
    /**
     * @var CommandBus
     */
    private $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param $command
     */
    public function dispatch($command): void
    {
        $this->bus->dispatch($command);
    }
}