<?php

namespace App\Event;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Service\Attribute\Required;

class TestEventHandler
{
    #[Required]
    public LoggerInterface $logger;

    public function __invoke(TestEvent $event): int
    {
        $this->logger->info('tutaj test event: '.$event->getUserId());

        return $event->getUserId() * 2;
    }
}
