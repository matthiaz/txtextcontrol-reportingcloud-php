<?php

namespace TxTextControlTest\ReportingCloud\Validator;

use PHPUnit_Framework_TestCase;
use TxTextControl\ReportingCloud\Validator\ZoomFactor as Validator;

class ZoomFactorTest extends PHPUnit_Framework_TestCase
{
    protected $validator;

    public function setUp()
    {
        $this->validator = new Validator();
    }

    public function testValid()
    {
        $this->assertTrue($this->validator->isValid(1));
        $this->assertTrue($this->validator->isValid(400));
    }

    public function testNotBetween()
    {
        $this->assertFalse($this->validator->isValid(0));
        $this->assertArrayHasKey('notBetween', $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid(-1));
        $this->assertArrayHasKey('notBetween', $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid(401));
        $this->assertArrayHasKey('notBetween', $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid('invalid'));
        $this->assertArrayHasKey('notBetween', $this->validator->getMessages());
    }

    public function testConstructor()
    {
        $validator = new Validator(null);

        $this->assertTrue($validator->isValid(1));
    }
}
