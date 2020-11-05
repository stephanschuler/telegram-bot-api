<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Sendable;

use StephanSchuler\TelegramBot\Api\Sendable;

final class GetMe implements Sendable
{
    use DescribeSendable;

    public static function create(): self
    {
        return new static();
    }
}