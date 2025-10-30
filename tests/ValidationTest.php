<?php

declare(strict_types=1);

namespace GreenValidator\Tests;

use GreenValidator\Validation;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    private Validation $validation;

    protected function setUp(): void
    {
        $this->validation = new Validation();
    }

    public function testGetIsValidReturnsFalseByDefault(): void
    {
        $this->assertFalse($this->validation->getIsValid());
    }

    public function testSetAndGetIsValid(): void
    {
        $this->validation->setIsValid(true);
        $this->assertTrue($this->validation->getIsValid());

        $this->validation->setIsValid(false);
        $this->assertFalse($this->validation->getIsValid());
    }

    public function testGetMessageReturnsEmptyStringByDefault(): void
    {
        $this->assertSame('', $this->validation->getMessage());
    }

    public function testSetAndGetMessage(): void
    {
        $message = 'Validation failed';
        $this->validation->setMessage($message);
        $this->assertSame($message, $this->validation->getMessage());
    }

    public function testIsValidMethod(): void
    {
        $this->validation->setIsValid(true);
        $this->assertTrue($this->validation->isValid());

        $this->validation->setIsValid(false);
        $this->assertFalse($this->validation->isValid());
    }

    public function testFailedMethod(): void
    {
        $this->validation->setIsValid(false);
        $this->assertTrue($this->validation->failed());

        $this->validation->setIsValid(true);
        $this->assertFalse($this->validation->failed());
    }
}
