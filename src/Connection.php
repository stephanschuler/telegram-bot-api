<?php
declare(strict_types=1);

namespace StephanSchuler\TelegramBot\Api;

use React\EventLoop\LoopInterface;
use React\Http\Browser;
use React\Promise\Promise;
use React\Promise\PromiseInterface;
use StephanSchuler\TelegramBot\Api\Types\ApiToken;
use function array_keys;
use function array_values;
use function json_encode;
use function str_replace;

final class Connection
{
    private const API_URL = 'https://api.telegram.org/bot<token>/<method>';

    private $token;
    private $loop;
    private $client;

    public function __construct(LoopInterface $loop, ApiToken $token)
    {
        $this->token = $token;
        $this->loop = $loop;
        $this->client = new Browser($this->loop);
    }

    public function send(Sendable $message): PromiseInterface
    {
        $method = $message->getMethodName();
        $vars = [
            '<token>' => $this->token,
            '<method>' => $method,
        ];
        $url = str_replace(array_keys($vars), array_values($vars), self::API_URL);

        $postArguments = $message->jsonSerialize();
        if (!$postArguments) {
            return $this
                ->client
                ->get($url);
        } else {
            return $this
                ->client
                ->post(
                    $url,
                    ['Content-Type' => 'application/json'],
                    json_encode($postArguments)
                );
        }
    }

    public function sendParallel(Sendable $message, Sendable ...$messages): PromiseInterface
    {
        $responses = array_map([$this, 'send'], $messages);
        return \React\Promise\all($responses);
    }

    public function sendAll(Sendable $message, Sendable ...$messages)
    {
        $messages = func_get_args();
        return new Promise(function (callable $resolver) use ($messages) {
            $responses = [];
            $sendNextMessage = function () use (&$messages, &$responses, &$sendNextMessage, &$resolver) {
                $next = array_shift($messages);
                if (!($next instanceof Sendable)) {
                    return $resolver($responses);
                }
                $this
                    ->send($next)
                    ->then(function ($response) use (&$messages, &$responses, &$sendNextMessage, &$resolver) {
                        $responses[] = $response;
                        $sendNextMessage();
                    });
            };
            $sendNextMessage();
        });
    }
}