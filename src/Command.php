<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api;

interface Command
{
    public function getCommand(): string;

    public function getDescription(): string;

    public function run($data);
}