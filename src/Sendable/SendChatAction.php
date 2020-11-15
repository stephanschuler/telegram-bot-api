<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Sendable;

use StephanSchuler\TelegramBot\Api\Sendable;
use StephanSchuler\TelegramBot\Api\Types\Chat;
use StephanSchuler\TelegramBot\Api\Types\ChatAction;

final class SendChatAction implements Sendable
{
    use DescribeSendable;

    private $chat_id;

    private $action;

    public function __construct(Chat $chat_id, ChatAction $action)
    {
        $this->chat_id = $chat_id;
        $this->action = $action;
    }

    public static function create(Chat $chatId, ChatAction $action): self
    {
        return new static($chatId, $action);
    }
}