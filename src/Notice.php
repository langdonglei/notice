<?php


namespace langdonglei;


use Exception;
use GuzzleHttp\Client;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Throwable;

class Notice
{
    /**
     * @throws Throwable
     */
    public function ding($message): string
    {
        if (!isset($_ENV['NOTICE_TOKEN'])) {
            throw new Exception('no env NOTICE_TOKEN');
        }
        if (!isset($_ENV['NOTICE_KEYWORD'])) {
            throw new Exception('no env NOTICE_KEYWORD');
        }
        $token   = $_ENV['NOTICE_TOKEN'];
        $keyword = $_ENV['NOTICE_KEYWORD'];

        $client = new Client([
            'timeout'     => 60,
            'verify'      => false,
            'http_errors' => false,
        ]);

        return $client->post("https://oapi.dingtalk.com/robot/send?access_token=$token", [
            'json' => [
                "msgtype" => "text",
                "text"    => [
                    "content" => "$keyword : $message",
                ]
            ]
        ])->getBody()->getContents();
    }

    public static function mail(string $dsn, string $message)
    {
        preg_match('|smtp://(.+):.+smtp\.(.+):|U', $dsn, $match);
        $from = $match[1] . '@' . $match[2];

        $transport = Transport::fromDsn($dsn);
        $mailer    = new Mailer($transport);
        $email     = new Email();
        $email->from($from);
        $email->to('langdonglei@icloud.com');
        $email->text($message);
        $mailer->send($email);
    }
}