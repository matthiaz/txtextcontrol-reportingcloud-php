<?php

namespace TxTextControlTest\ReportingCloud\Validator;

use PHPUnit_Framework_TestCase;
use TxTextControl\ReportingCloud\Validator\ImageFormats as Validator;

class ImageFormatsTest extends PHPUnit_Framework_TestCase
{
    protected $validator;

    public function setUp()
    {
        $this->validator = new Validator();
    }

    public function testValid()
    {
        $this->assertTrue($this->validator->isValid('png'));
        $this->assertTrue($this->validator->isValid('PNG'));
    }

    public function testNotInArray()
    {
        $this->assertFalse($this->validator->isValid('doc'));
        $this->assertArrayHasKey('notInArray', $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid('DOC'));
        $this->assertArrayHasKey('notInArray', $this->validator->getMessages());
    }

}
