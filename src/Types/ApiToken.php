<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Types;

final class ApiToken
{
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function __toString(): string
    {
        return $this->token;
    }
}