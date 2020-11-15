<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Sendable;

use function array_filter;
use function end;
use function explode;
use function get_object_vars;
use function ucfirst;

trait DescribeSendable
{
    public function getMethodName(): string
    {
        $className = self::class;
        $className = explode('\\', $className);
        $className = end($className);
        return ucfirst($className);
    }

    public function jsonSerialize(): array
    {
        return array_filter(
            get_object_vars($this),
            function ($value) {
                return $value !== null;
            }
        );
    }
}