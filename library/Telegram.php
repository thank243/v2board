<?php
namespace Library;

use \Curl\Curl;

class Telegram {
    protected $api;

    public function __construct()
    {
        $this->api = 'https://api.telegram.org/bot' . config('v2board.telegram_bot_token') . '/';
    }

    public function sendMessage(int $chatId, string $text, string $parseMode = '')
    {
        $this->request('sendMessage', [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => $parseMode
        ]);
    }

    public function getMe()
    {
        dd($this->request('getMe'));
    }

    private function request(string $method, array $params)
    {
        $curl = new Curl();
        $curl->get($this->api . $method, http_build_query($params));
        $curl->close();
        return $curl->response;
    }
}
