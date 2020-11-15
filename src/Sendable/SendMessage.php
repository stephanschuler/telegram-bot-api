<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Sendable;

use StephanSchuler\TelegramBot\Api\Sendable;
use StephanSchuler\TelegramBot\Api\Types\Chat;
use StephanSchuler\TelegramBot\Api\Types\MessageEntity;
use StephanSchuler\TelegramBot\Api\Types\Message;
use StephanSchuler\TelegramBot\Api\Types\ParseMode;

final class SendMessage implements Sendable
{
    use DescribeSendable;

    private $chat_id;
    private $text;
    private $parse_mode;
    private $disable_web_page_preview;
    private $disable_notification;
    private $reply_to_message_id;
    private $reply_markup;
    private $entities;

    public function __construct(
        Chat $chat_id,
        Message $text,
        ?ParseMode $parse_mode,
        bool $disable_web_page_preview,
        bool $disable_notification,
        ?int $reply_to_message_id,
        ?array $entities
    ) {
        $this->chat_id = $chat_id;
        $this->text = $text;
        $this->parse_mode = $parse_mode;
        $this->disable_web_page_preview = $disable_web_page_preview;
        $this->disable_notification = $disable_notification;
        $this->reply_to_message_id = $reply_to_message_id;
        $this->entities = $entities;
    }

    public static function create(Chat $chatId, Message $text): self
    {
        return new static(
            $chatId,
            $text,
            null,
            false,
            false,
            null,
            null
        );
    }

    public function withParseMode(ParseMode $parseMode): self
    {
        return new static(
            $this->chat_id,
            $this->text,
            $parseMode,
            $this->disable_web_page_preview,
            $this->disable_notification,
            $this->reply_to_message_id,
            null
        );
    }

    public function withoutWebPagePreview(): self
    {
        return new static(
            $this->chat_id,
            $this->text,
            $this->parse_mode,
            true,
            $this->disable_notification,
            $this->reply_to_message_id,
            null
        );
    }

    public function withoutNotification(): self
    {
        return new static(
            $this->chat_id,
            $this->text,
            $this->parse_mode,
            $this->disable_web_page_preview,
            true,
            $this->reply_to_message_id,
            null
        );
    }

    public function withEntity(MessageEntity $entity): self
    {
        $entities = $this->entities ?? [];
        $entities[] = $entity;
        return new static(
            $this->chat_id,
            $this->text,
            $this->parse_mode,
            $this->disable_web_page_preview,
            $this->disable_notification,
            $this->reply_to_message_id,
            $entities
        );
    }

    public function asReplyTo(int $messageId): self
    {
        return new static(
            $this->chat_id,
            $this->text,
            $this->parse_mode,
            $this->disable_web_page_preview,
            $this->disable_notification,
            $messageId,
            null
        );
    }
}