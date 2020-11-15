<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api;

interface Sendable extends \JsonSerializable
{
    public function getMethodName(): string;

    public function jsonSerialize(): array;
}