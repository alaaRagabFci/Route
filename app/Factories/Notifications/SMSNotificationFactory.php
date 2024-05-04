<?php

namespace App\Factories\Notifications;

use App\Enums\SMSProvidersEnum;
use App\Notifications\SMS\CequenceNotification;

class SMSNotificationFactory
{
    /**
     * @var array|string[]
     */
    private static array $mapper = [
        SMSProvidersEnum::VICTORY_LINK => CequenceNotification::class,
    ];


    /**
     * @param string $type
     * @return mixed|null
     */
    public static function getNotificationClassByType(string $type): mixed
    {
        return isset(self::$mapper[$type]) ? new self::$mapper[$type] : null;
    }
}
