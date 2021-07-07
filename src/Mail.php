<?php


namespace langdonglei;


use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class Mail
{
    /**
     * @param string $dsn
     * @param string $message
     * @throws TransportExceptionInterface
     */
    public static function send(string $dsn, string $message)
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