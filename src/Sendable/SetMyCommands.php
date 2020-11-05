<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Sendable;

use StephanSchuler\TelegramBot\Api\Command;
use StephanSchuler\TelegramBot\Api\Sendable;

final class SetMyCommands implements Sendable
{
    use DescribeSendable;

    private $commands;

    public function __construct(...$commands)
    {
        $this->commands = $commands;
    }

    public static function create(): self
    {
        return new static();
    }

    public function withCommand(Command $command): self
    {
        return new static(
            ['command' => $command->getCommand(), 'description' => $command->getDescription()],
            ...$this->commands
        );
    }
}