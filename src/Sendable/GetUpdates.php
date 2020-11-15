<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api\Sendable;

use StephanSchuler\TelegramBot\Api\Sendable;

final class GetUpdates implements Sendable
{
    use DescribeSendable;

    private $offset;
    private $timeout;
    private $limit;

    public function __construct(?int $offset, ?int $timeout, ?int $limit)
    {
        $this->offset = $offset;
        $this->timeout = $timeout;
        $this->limit = $limit;
    }

    public static function create(): self
    {
        return new static(null, null, null);
    }

    public function withOffset(int $offset): self
    {
        return new static(
            $offset,
            $this->timeout,
            $this->limit
        );
    }

    public function withTimeout(int $timeout): self
    {
        return new static(
            $this->offset,
            $timeout,
            $this->limit
        );
    }

    public function withLimit(int $limit): self
    {
        return new static(
            $this->offset,
            $this->timeout,
            $limit
        );
    }
}