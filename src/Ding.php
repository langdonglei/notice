<?php

namespace langdonglei;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class Ding
{
    /**
     * @param string $token
     * @param string $keyword
     * @param string $message
     * @return string
     * @throws GuzzleException
     */
    public static function send(string $token, string $keyword, string $message = 'default message'): string
    {
        return (new Client([
            'timeout'     => 60,
            'verify'      => false,
            'http_errors' => false,
        ]))->request('post', 'https://oapi.dingtalk.com/robot/send?access_token=' . $token, [
            'json' => [
                "msgtype" => "text",
                "text"    => [
                    "content" => "$keyword : $message",
                ]
            ]
        ])->getBody()->getContents();
    }
}