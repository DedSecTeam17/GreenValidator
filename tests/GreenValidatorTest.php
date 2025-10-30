<?php

declare(strict_types=1);

namespace GreenValidator\Tests;

use GreenValidator\GreenValidator;
use PHPUnit\Framework\TestCase;

class GreenValidatorTest extends TestCase
{
    private GreenValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new GreenValidator();
    }

    public function testEmailValidation(): void
    {
        $this->assertTrue($this->validator->isEmail('test@example.com'));
        $this->assertTrue($this->validator->isEmail('user.name@example.co.uk'));
        $this->assertFalse($this->validator->isEmail('invalid-email'));
        $this->assertFalse($this->validator->isEmail('no-at-sign.com'));
    }

    public function testNumberValidation(): void
    {
        $this->assertTrue($this->validator->isNumber('123'));
        $this->assertTrue($this->validator->isNumber('0'));
        $this->assertFalse($this->validator->isNumber('12.34'));
        $this->assertFalse($this->validator->isNumber('abc'));
    }

    public function testFloatValidation(): void
    {
        $this->assertTrue($this->validator->isFloat('3.14'));
        $this->assertTrue($this->validator->isFloat('0.5'));
        $this->assertTrue($this->validator->isFloat('123'));
        $this->assertFalse($this->validator->isFloat('abc'));
    }

    public function testStringValidation(): void
    {
        $this->assertTrue($this->validator->isStringOnly('Hello World'));
        $this->assertTrue($this->validator->isStringOnly('Test123'));
        $this->assertFalse($this->validator->isStringOnly('test@example'));
        $this->assertFalse($this->validator->isStringOnly('test!'));
    }

    public function testAlphaValidation(): void
    {
        $this->assertTrue($this->validator->isAlpha('HelloWorld'));
        $this->assertTrue($this->validator->isAlpha('Test String'));
        $this->assertFalse($this->validator->isAlpha('Test123'));
        $this->assertFalse($this->validator->isAlpha('test@example'));
    }

    public function testAlphaNumericValidation(): void
    {
        $this->assertTrue($this->validator->isAlphaNumeric('Test123'));
        $this->assertTrue($this->validator->isAlphaNumeric('ABC'));
        $this->assertFalse($this->validator->isAlphaNumeric('Test 123'));
        $this->assertFalse($this->validator->isAlphaNumeric('test@example'));
    }

    public function testUrlValidation(): void
    {
        $this->assertTrue($this->validator->isUrl('https://example.com'));
        $this->assertTrue($this->validator->isUrl('http://www.example.com/path'));
        $this->assertTrue($this->validator->isUrl('https://example.com/path?query=value'));
        $this->assertFalse($this->validator->isUrl('not a url'));
        $this->assertFalse($this->validator->isUrl('example.com'));
    }

    public function testIpValidation(): void
    {
        $this->assertTrue($this->validator->isIp('192.168.1.1'));
        $this->assertTrue($this->validator->isIp('2001:0db8:85a3:0000:0000:8a2e:0370:7334'));
        $this->assertFalse($this->validator->isIp('999.999.999.999'));
        $this->assertFalse($this->validator->isIp('not an ip'));
    }

    public function testIpv4Validation(): void
    {
        $this->assertTrue($this->validator->isIpv4('192.168.1.1'));
        $this->assertTrue($this->validator->isIpv4('10.0.0.1'));
        $this->assertFalse($this->validator->isIpv4('2001:0db8:85a3:0000:0000:8a2e:0370:7334'));
        $this->assertFalse($this->validator->isIpv4('999.999.999.999'));
    }

    public function testIpv6Validation(): void
    {
        $this->assertTrue($this->validator->isIpv6('2001:0db8:85a3:0000:0000:8a2e:0370:7334'));
        $this->assertTrue($this->validator->isIpv6('2001:db8::1'));
        $this->assertFalse($this->validator->isIpv6('192.168.1.1'));
        $this->assertFalse($this->validator->isIpv6('not an ipv6'));
    }

    public function testJsonValidation(): void
    {
        $this->assertTrue($this->validator->isJson('{"name":"John","age":30}'));
        $this->assertTrue($this->validator->isJson('["item1","item2"]'));
        $this->assertFalse($this->validator->isJson('not json'));
        $this->assertFalse($this->validator->isJson('{invalid json}'));
    }

    public function testDateValidation(): void
    {
        $this->assertTrue($this->validator->isDate('2023-12-25'));
        $this->assertTrue($this->validator->isDate('2024-01-01'));
        $this->assertFalse($this->validator->isDate('2023-13-32'));
        $this->assertFalse($this->validator->isDate('not a date'));
    }

    public function testDateWithCustomFormat(): void
    {
        $this->assertTrue($this->validator->isDate('25/12/2023', 'd/m/Y'));
        $this->assertTrue($this->validator->isDate('12-25-2023', 'm-d-Y'));
        $this->assertFalse($this->validator->isDate('2023-12-25', 'd/m/Y'));
    }

    public function testBooleanValidation(): void
    {
        $this->assertTrue($this->validator->isBoolean(true));
        $this->assertTrue($this->validator->isBoolean(false));
        $this->assertTrue($this->validator->isBoolean('true'));
        $this->assertTrue($this->validator->isBoolean('false'));
        $this->assertTrue($this->validator->isBoolean('1'));
        $this->assertTrue($this->validator->isBoolean('0'));
        $this->assertFalse($this->validator->isBoolean('not a boolean'));
    }

    public function testMinValidation(): void
    {
        $this->assertTrue($this->validator->min('Hello', 3));
        $this->assertTrue($this->validator->min('Hello', 5));
        $this->assertFalse($this->validator->min('Hi', 3));
    }

    public function testMaxValidation(): void
    {
        $this->assertTrue($this->validator->max('Hello', 10));
        $this->assertTrue($this->validator->max('Hello', 5));
        $this->assertFalse($this->validator->max('Hello World', 5));
    }

    public function testRequiredValidation(): void
    {
        $this->assertTrue($this->validator->isRequired('value'));
        $this->assertTrue($this->validator->isRequired('0'));
        $this->assertFalse($this->validator->isRequired(''));
        $this->assertFalse($this->validator->isRequired('   '));
        $this->assertFalse($this->validator->isRequired(null));
    }

    public function testInValidation(): void
    {
        $this->assertTrue($this->validator->isIn('active', ['active', 'inactive', 'pending']));
        $this->assertTrue($this->validator->isIn('admin', ['admin', 'user', 'guest']));
        $this->assertFalse($this->validator->isIn('superuser', ['admin', 'user', 'guest']));
    }

    public function testBetweenValidation(): void
    {
        $this->assertTrue($this->validator->isBetween('25', 18, 65));
        $this->assertTrue($this->validator->isBetween('18', 18, 65));
        $this->assertTrue($this->validator->isBetween('65', 18, 65));
        $this->assertFalse($this->validator->isBetween('17', 18, 65));
        $this->assertFalse($this->validator->isBetween('66', 18, 65));
    }

    public function testConfirmedValidation(): void
    {
        $this->assertTrue($this->validator->isConfirmed('password', 'password'));
        $this->assertTrue($this->validator->isConfirmed('123', '123'));
        $this->assertFalse($this->validator->isConfirmed('password', 'different'));
    }

    public function testRegexValidation(): void
    {
        $this->assertTrue($this->validator->matchesRegex('ABC123', '/^[A-Z]{3}[0-9]{3}$/'));
        $this->assertTrue($this->validator->matchesRegex('test@example.com', '/^[\w\.-]+@[\w\.-]+\.\w+$/'));
        $this->assertFalse($this->validator->matchesRegex('abc123', '/^[A-Z]{3}[0-9]{3}$/'));
    }

    public function testValidateMethodWithEmail(): void
    {
        $result = $this->validator->validate([
            'test@example.com' => 'email',
        ])->execute();

        $this->assertTrue($result->isValid());
    }

    public function testValidateMethodWithInvalidEmail(): void
    {
        $result = $this->validator->validate([
            'invalid-email' => 'email',
        ])->execute();

        $this->assertFalse($result->isValid());
        $this->assertStringContainsString('not a valid email', $result->getMessage());
    }

    public function testValidateMethodWithMultipleRules(): void
    {
        $result = $this->validator->validate([
            'John Doe' => 'string|min:5|max:20',
            'test@example.com' => 'email',
            '12345' => 'number',
        ])->execute();

        $this->assertTrue($result->isValid());
    }

    public function testValidateMethodWithComplexRules(): void
    {
        $result = $this->validator->validate([
            'john.doe@example.com' => 'required|email',
            'JohnDoe123' => 'required|alphanumeric|min:6|max:20',
            'https://example.com' => 'required|url',
            '25' => 'required|number|between:18,100',
        ])->execute();

        $this->assertTrue($result->isValid());
    }

    public function testPassesMethod(): void
    {
        $this->validator->validate([
            'test@example.com' => 'email',
        ]);

        $this->assertTrue($this->validator->passes());
    }

    public function testFailsMethod(): void
    {
        $this->validator->validate([
            'invalid-email' => 'email',
        ]);

        $this->assertTrue($this->validator->fails());
    }

    public function testGetErrors(): void
    {
        $this->validator->validate([
            'invalid-email' => 'email',
            'abc' => 'number',
        ]);

        $errors = $this->validator->getErrors();
        $this->assertCount(2, $errors);
    }
}
