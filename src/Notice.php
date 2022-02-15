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
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'timeout'     => 60,
            'verify'      => false,
            'http_errors' => false,
        ]);
    }

    /**
     * @throws Throwable
     */
    public function ding($message): string
    {
        $_ENV['NOTICE_DING_TOKEN'] ?? throw new Exception('no env NOTICE_DING_TOKEN');
        $_ENV['NOTICE_DING_KEYWORD'] ?? throw new Exception('no env NOTICE_DING_KEYWORD');

        return $this->client->post("https://oapi.dingtalk.com/robot/send?access_token={$_ENV['NOTICE_DING_TOKEN']}", [
            'json' => [
                "msgtype" => "text",
                "text"    => [
                    "content" => "{$_ENV['NOTICE_DING_KEYWORD']} : $message",
                ]
            ]
        ])->getBody()->getContents();
    }

    /**
     * @throws Throwable
     */
    public function mail($message)
    {
        $_ENV['NOTICE_MAIL_DSN'] ?? throw new Exception('no env NOTICE_MAIL_DSN example->smtp://user:pass@smtp.sina.com:25');
        $_ENV['NOTICE_MAIL_TO'] ?? throw new Exception('no env NOTICE_MAIL_TO');

        preg_match('|smtp://(.+):.+smtp\.(.+):|U', $_ENV['NOTICE_MAIL_DSN'], $matches);

        $from      = $matches[1] . '@' . $matches[2];
        $transport = Transport::fromDsn($_ENV['NOTICE_MAIL_DSN']);
        $mailer    = new Mailer($transport);
        $email     = new Email();
        $email->from($from);
        $email->to($_ENV['NOTICE_MAIL_TO']);
        $email->text($message);
        $mailer->send($email);
    }
}