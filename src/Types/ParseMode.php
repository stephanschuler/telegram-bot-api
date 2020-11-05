<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Types;

use JsonSerializable;

final class ParseMode implements JsonSerializable
{
    private $subject;

    private function __construct($subject)
    {
        $this->subject = $subject;
    }

    public static function html(): self
    {
        return new static('HTML');
    }

    public static function markdownV2(): self
    {
        return new static('MarkdownV2');
    }

    public static function markdown(): self
    {
        return new static('Markdown');
    }

    public function jsonSerialize()
    {
        return $this->subject;
    }
}