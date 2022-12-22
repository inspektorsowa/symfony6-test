<?php

namespace App\Message;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Service\Attribute\Required;

class TestMessageHandler
{
    #[Required]
    public LoggerInterface $logger;

    public function __invoke(TestMessage $message): void
    {
        $this->logger->info(__CLASS__ . ': ' . $message->getMessage());
    }
}
