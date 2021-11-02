<?php


use GuzzleHttp\Exception\GuzzleException;
use langdonglei\Ding;
use PHPUnit\Framework\TestCase;

class DingTest extends TestCase
{

    /**
     * @throws GuzzleException
     */
    public function testSend()
    {
        $str = Ding::send(
            'e49ba2aac4d8204beeb2eacbae7fac566eae6673d070679406cb419be6053701',
            'KEUN8180',
            'test');
        self::assertSame('{"errcode":0,"errmsg":"ok"}', $str);
    }
}
