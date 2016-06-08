<?php

namespace TxTextControlTest\ReportingCloud\Validator;

use PHPUnit_Framework_TestCase;
use TxTextControl\ReportingCloud\Validator\DateTime as Validator;

class DateTimeTest extends PHPUnit_Framework_TestCase
{
    protected $validator;

    public function setUp()
    {
        $this->validator = new Validator();
    }

    public function testValid()
    {
        $this->assertTrue($this->validator->isValid('2016-06-02T15:49:57+00:00'));
        $this->assertTrue($this->validator->isValid('1980-06-02T15:49:57+00:00'));
    }

    public function testInvalidType()
    {
        $this->assertFalse($this->validator->isValid(123));
        $this->assertArrayHasKey('invalidType', $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid(-123));
        $this->assertArrayHasKey('invalidType', $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid(0));
        $this->assertArrayHasKey('invalidType', $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid(1.1));
        $this->assertArrayHasKey('invalidType', $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid(true));
        $this->assertArrayHasKey('invalidType', $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid(false));
        $this->assertArrayHasKey('invalidType', $this->validator->getMessages());
    }

    public function testInvalidLength()
    {
        $this->assertFalse($this->validator->isValid('2016-06-02T15:49:57+00:00:00'));
        $this->assertArrayHasKey('invalidLength', $this->validator->getMessages());
    }

    public function testInvalidSyntax()
    {
        $this->assertFalse($this->validator->isValid('xxxx-06-02T15:49:57+00:00'));
        $this->assertArrayHasKey('invalidSyntax', $this->validator->getMessages());
    }

    public function testInvalidOffset()
    {
        $this->assertFalse($this->validator->isValid('2016-06-02T15:49:57+02:00'));
        $this->assertArrayHasKey('invalidOffset', $this->validator->getMessages());
    }
}
