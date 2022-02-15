<?php

namespace test;

use langdonglei\Notice;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Dotenv\Dotenv;

class NoticeTest extends TestCase
{
    private Notice $class;

    public function __construct()
    {
        $env = new Dotenv();
        $env->load('.env');
        parent::__construct();
        $this->class = new Notice();
    }

    public function testDing()
    {
        $res = $this->class->ding('test3');
        var_dump($res);
    }

    public function testMail()
    {
        $this->class->mail('test1');
    }
}
