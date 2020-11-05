<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Types;

use JsonSerializable;

class Message implements JsonSerializable
{
    private $factory;

    final protected function __construct(callable $factory)
    {
        $this->factory = $factory;
    }

    final public static function static(string $body): self
    {
        return new static(static function () use ($body) {
            return $body;
        });
    }

    final public static function dynamic(callable $factory): self
    {
        return new static($factory);
    }

    final public function jsonSerialize(): string
    {
        return $this->getBody();
    }

    public function getBody(): string
    {

        return ($this->factory)();
    }
}