<?php

namespace test;

use langdonglei\Notice;
use PHPUnit\Framework\TestCase;

class NoticeTest extends TestCase
{
    public function testDing()
    {

        (new Notice())->ding('test');
    }
}
