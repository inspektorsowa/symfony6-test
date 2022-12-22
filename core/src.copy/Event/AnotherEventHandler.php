<?php

namespace App\Event;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Service\Attribute\Required;

class AnotherEventHandler
{
    #[Required]
    public LoggerInterface $logger;

    public function __invoke(TestEvent $event): void
    {
        $this->logger->info('another event ' . time());
    }
}
