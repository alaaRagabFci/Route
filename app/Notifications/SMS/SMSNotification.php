<?php

namespace App\Notifications\SMS;

use Illuminate\Contracts\Queue\ShouldQueue;

abstract class SMSNotification implements ShouldQueue
{
    /**
     * @var string
     */
    protected string $apiKey;

    abstract protected function getAuthorizationKey(): string;

    abstract protected function send(string $text, string $recipients): void;
}
