<?php

namespace App\Domain\Shared\Event;

interface DomainEventDispatcherInterface
{
    public function dispatch(DomainEventInterface $event);
}
