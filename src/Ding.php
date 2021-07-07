<?php

namespace langdonglei;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class Ding
{
    /**
     * @param string $token
     * @param string $message
     * @throws GuzzleException
     */
    public static function send(string $token, string $message)
    {
        (new Client([
            'timeout'     => 60,
            'verify'      => false,
            'http_errors' => false,
        ]))->request('post', 'https://oapi.dingtalk.com/robot/send?access_token=' . $token, [
            'json' => [
                "msgtype" => "text",
                "text"    => [
                    "content" => 'KEUN8180  :  ' . $message,
                ]
            ]
        ]);
    }
}