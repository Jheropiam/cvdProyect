<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Custom\phpqrcode\qrlib;
use QRcode;

class qrtest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        QRcode::png('code data text', 'filename.png');
        $this->assertTrue(true);
    }
}
