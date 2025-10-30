<?php
/**
 * Modern GreenValidator Examples
 * 
 * Demonstrates all the new validation features in GreenValidator
 */

require_once __DIR__ . '/src/GreenValidator.php';
require_once __DIR__ . '/src/Validation.php';

use GreenValidator\GreenValidator;

echo "=== GreenValidator - Modern PHP Examples ===\n\n";

// Example 1: Basic Validations
echo "1. Basic Validations:\n";
$validator = new GreenValidator();
$result = $validator->validate([
    'john.doe@example.com' => 'email',
    '12345' => 'number',
    'Hello World' => 'string',
    '3.14159' => 'float',
])->execute();

if ($result->isValid()) {
    echo "   ✓ All basic validations passed!\n\n";
} else {
    echo "   ✗ Validation failed:\n   " . str_replace('<br>', "\n   ", $result->getMessage()) . "\n\n";
}

// Example 2: String Length Validations
echo "2. String Length Validations:\n";
$validator = new GreenValidator();
$result = $validator->validate([
    'John Doe' => 'string|min:5|max:20',
    'user123' => 'alphanumeric|min:3|max:15',
])->execute();

if ($result->isValid()) {
    echo "   ✓ String length validations passed!\n\n";
} else {
    echo "   ✗ Validation failed:\n   " . str_replace('<br>', "\n   ", $result->getMessage()) . "\n\n";
}

// Example 3: Advanced Validations
echo "3. Advanced Validations:\n";
$validator = new GreenValidator();
$result = $validator->validate([
    'https://github.com' => 'url',
    '192.168.1.1' => 'ip',
    '2023-12-25' => 'date',
    'JohnDoe' => 'alpha',
])->execute();

if ($result->isValid()) {
    echo "   ✓ Advanced validations passed!\n\n";
} else {
    echo "   ✗ Validation failed:\n   " . str_replace('<br>', "\n   ", $result->getMessage()) . "\n\n";
}

// Example 4: Complex JSON Validation
echo "4. JSON Validation:\n";
$validator = new GreenValidator();
$jsonData = '{"name":"John","age":30}';
$result = $validator->validate([
    $jsonData => 'json',
])->execute();

if ($result->isValid()) {
    echo "   ✓ JSON validation passed!\n\n";
} else {
    echo "   ✗ Validation failed:\n   " . str_replace('<br>', "\n   ", $result->getMessage()) . "\n\n";
}

// Example 5: IP Address Validations
echo "5. IP Address Validations:\n";
$validator = new GreenValidator();
$result = $validator->validate([
    '192.168.1.1' => 'ipv4',
    '2001:0db8:85a3:0000:0000:8a2e:0370:7334' => 'ipv6',
])->execute();

if ($result->isValid()) {
    echo "   ✓ IP validations passed!\n\n";
} else {
    echo "   ✗ Validation failed:\n   " . str_replace('<br>', "\n   ", $result->getMessage()) . "\n\n";
}

// Example 6: Between Validation
echo "6. Between (Range) Validation:\n";
$validator = new GreenValidator();
$result = $validator->validate([
    '25' => 'between:18,65',
    '3.14' => 'between:0,10',
])->execute();

if ($result->isValid()) {
    echo "   ✓ Range validations passed!\n\n";
} else {
    echo "   ✗ Validation failed:\n   " . str_replace('<br>', "\n   ", $result->getMessage()) . "\n\n";
}

// Example 7: In (Enum) Validation
echo "7. In (Enum) Validation:\n";
$validator = new GreenValidator();
$result = $validator->validate([
    'active' => 'in:active,inactive,pending',
    'admin' => 'in:admin,user,guest',
])->execute();

if ($result->isValid()) {
    echo "   ✓ Enum validations passed!\n\n";
} else {
    echo "   ✗ Validation failed:\n   " . str_replace('<br>', "\n   ", $result->getMessage()) . "\n\n";
}

// Example 8: Regex Pattern Validation
echo "8. Custom Regex Validation:\n";
$validator = new GreenValidator();
$result = $validator->validate([
    'ABC-123' => 'regex:/^[A-Z]{3}-[0-9]{3}$/',
])->execute();

if ($result->isValid()) {
    echo "   ✓ Regex validation passed!\n\n";
} else {
    echo "   ✗ Validation failed:\n   " . str_replace('<br>', "\n   ", $result->getMessage()) . "\n\n";
}

// Example 9: Required Field Validation
echo "9. Required Field Validation:\n";
$validator = new GreenValidator();
$result = $validator->validate([
    'John Doe' => 'required|string',
    'john@example.com' => 'required|email',
])->execute();

if ($result->isValid()) {
    echo "   ✓ Required field validations passed!\n\n";
} else {
    echo "   ✗ Validation failed:\n   " . str_replace('<br>', "\n   ", $result->getMessage()) . "\n\n";
}

// Example 10: Complex Multi-Rule Validation
echo "10. Complex Multi-Rule Validation:\n";
$validator = new GreenValidator();
$result = $validator->validate([
    'john.doe@example.com' => 'required|email',
    'JohnDoe123' => 'required|alphanumeric|min:6|max:20',
    'https://example.com' => 'required|url',
    '25' => 'required|number|between:18,100',
    '2024-01-15' => 'required|date',
])->execute();

if ($result->isValid()) {
    echo "   ✓ All complex validations passed!\n\n";
} else {
    echo "   ✗ Validation failed:\n   " . str_replace('<br>', "\n   ", $result->getMessage()) . "\n\n";
}

// Example 11: Testing Validation Failures
echo "11. Intentional Validation Failures (for testing):\n";
$validator = new GreenValidator();
$result = $validator->validate([
    'not-an-email' => 'email',
    'abc' => 'number',
    '999' => 'between:0,100',
])->execute();

if ($result->failed()) {
    echo "   ✓ Validation correctly failed:\n";
    echo "   " . str_replace('<br>', "\n   ", $result->getMessage()) . "\n\n";
} else {
    echo "   ✗ Validation should have failed!\n\n";
}

echo "=== All Examples Complete ===\n";
