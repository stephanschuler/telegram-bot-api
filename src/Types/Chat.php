<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Types;

use JsonSerializable;

final class Chat implements JsonSerializable
{
    private $subject;

    private function __construct($subject)
    {
        $this->subject = $subject;
    }

    public static function forUser(int $userId): self
    {
        return new static($userId);
    }

    public function equals(self $other): bool
    {
        return $this->subject === $other->subject;
    }

    public function jsonSerialize()
    {
        return $this->subject;
    }
}