<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Types;

use JsonSerializable;

final class ChatAction implements JsonSerializable
{
    private $subject;

    private function __construct($subject)
    {
        $this->subject = $subject;
    }

    public static function typing(): self
    {
        return new static('typing');
    }

    public static function uploadPhoto(): self
    {
        return new static('upload_photo');
    }

    public static function recordVideo(): self
    {
        return new static('record_video');
    }

    public static function uploadVideo(): self
    {
        return new static('upload_video');
    }

    public static function recordAudio(): self
    {
        return new static('record_audio');
    }

    public static function uploadAudio(): self
    {
        return new static('upload_audio');
    }

    public static function uploadDocument(): self
    {
        return new static('upload_document');
    }

    public static function findLocation(): self
    {
        return new static('find_location');
    }

    public static function recordVideoNote(): self
    {
        return new static('record_video_note');
    }

    public static function uploadVideoNote(): self
    {
        return new static('upload_video_note');
    }

    public function jsonSerialize()
    {
        return $this->subject;
    }
}