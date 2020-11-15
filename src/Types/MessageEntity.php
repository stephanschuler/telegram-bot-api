<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Types;

use JsonSerializable;
use function array_filter;
use function get_object_vars;

final class MessageEntity implements JsonSerializable
{
    private $type;
    private $offset;
    private $length;
    private $url;
    private $user;
    private $language;

    private function __construct(string $type, int $offset, int $length, ?string $url, ?string $user, ?string $language)
    {
        $this->type = $type;
        $this->offset = $offset;
        $this->length = $length;
        $this->url = $url;
        $this->user = $user;
        $this->language = $language;
    }

    public static function mention(): self
    {
        return new static('mention', 0, 0, null, null, null);
    }


    public static function hashtag(): self
    {
        return new static('hashtag', 0, 0, null, null, null);
    }


    public static function cashtag(): self
    {
        return new static('cashtag', 0, 0, null, null, null);
    }


    public static function botCommand(): self
    {
        return new static('bot_command', 0, 0, null, null, null);
    }


    public static function url(): self
    {
        return new static('url', 0, 0, null, null, null);
    }


    public static function email(): self
    {
        return new static('email', 0, 0, null, null, null);
    }


    public static function phoneNumber(): self
    {
        return new static('phone_number', 0, 0, null, null, null);
    }


    public static function bold(): self
    {
        return new static('bold', 0, 0, null, null, null);
    }


    public static function italic(): self
    {
        return new static('italic', 0, 0, null, null, null);
    }


    public static function underline(): self
    {
        return new static('underline', 0, 0, null, null, null);
    }


    public static function strikethrough(): self
    {
        return new static('strikethrough', 0, 0, null, null, null);
    }


    public static function code(): self
    {
        return new static('code', 0, 0, null, null, null);
    }


    public static function preformated(?string $language = null): self
    {
        return new static('pre', 0, 0, null, null, $language);
    }


    public static function textLink(string $url): self
    {
        return new static('text_link', 0, 0, $url, null, null);
    }


    public static function textMention(string $user): self
    {
        return new static('text_mention', 0, 0, null, $user, null);
    }

    public function fromOffset(int $offset): self
    {
        return new static(
            $this->type,
            $offset,
            $this->length,
            $this->url,
            $this->url,
            $this->language
        );
    }

    public function withLength(int $length): self
    {
        return new static(
            $this->type,
            $this->offset,
            $length,
            $this->url,
            $this->url,
            $this->language
        );
    }

    public function restrictedTo(int $offset, int $length): self
    {
        return $this
            ->fromOffset($offset)
            ->withLength($length);
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