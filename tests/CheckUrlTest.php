<?php

namespace Hoanguyencoder\HttpStatus\Tests;

use PHPUnit\Framework\TestCase;
use Hoanguyencoder\HttpStatus\lib\CheckUrl;

class CheckUrlTest extends TestCase
{
    public function testIsUrlWithValidUrl()
    {
        $this->assertTrue(CheckUrl::isUrl('https://example.com'));
    }

    public function testIsUrlWithInvalidUrl()
    {
        $this->assertFalse(CheckUrl::isUrl('not-a-url'));
    }

    public function testCheckReturnsStatusCodeForValidUrl()
    {
        $statusCode = CheckUrl::check('https://example.com');

        $this->assertIsInt($statusCode);
        $this->assertGreaterThanOrEqual(200, $statusCode);
    }

    public function testCheckReturnsZeroForInvalidUrl()
    {
        $this->assertEquals(0, CheckUrl::check('invalid-url'));
    }
}
