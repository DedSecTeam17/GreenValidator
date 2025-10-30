# Upgrade Guide

## Upgrading from 1.x to 2.0

### Overview

GreenValidator 2.0 is a major update that brings modern PHP 8.1+ features and extensive new validation rules. **The good news**: it's 100% backward compatible! Your existing code will continue to work without any changes.

### What's New

- **PHP 8.1+ Features**: Strict types, property types, match expressions
- **20+ Validation Rules**: From basic to complex validations
- **Composer Support**: PSR-4 autoloading and proper dependency management
- **Full Test Coverage**: 37 PHPUnit tests ensuring reliability
- **Better Documentation**: Comprehensive examples for all features

### Backward Compatibility

All existing code continues to work:

```php
// Old code (still works!)
require_once 'GreenValidator.php';

$validator = new GreenValidator();
$result = $validator->validate([
    'john@example.com' => 'email',
    'John Doe' => 'string|min:5|max:20'
])->execute();

if ($result->getisValid()) {
    echo 'Valid!';
}
```

### Recommended Migration (Optional)

For new projects or when refactoring, we recommend using the namespaced version:

```php
use GreenValidator\GreenValidator;

$validator = new GreenValidator();
$result = $validator->validate([
    'john@example.com' => 'required|email',
    'John Doe' => 'required|string|min:5|max:20',
    'https://example.com' => 'url',
    '25' => 'number|between:18,100'
])->execute();

if ($result->isValid()) {
    echo 'Valid!';
}
```

### New Features You Can Use

#### 1. Additional Validation Rules

```php
// URL validation
'https://example.com' => 'url'

// IP address validation
'192.168.1.1' => 'ipv4'
'2001:db8::1' => 'ipv6'

// JSON validation
'{"name":"John"}' => 'json'

// Date validation
'2024-01-15' => 'date'
'15/01/2024' => 'date:d/m/Y'  // custom format

// Alpha/alphanumeric
'JohnDoe' => 'alpha'
'User123' => 'alphanumeric'

// Required fields
'value' => 'required|string'

// Range validation
'25' => 'between:18,65'

// Enum validation
'active' => 'in:active,inactive,pending'

// Custom regex
'ABC-123' => 'regex:/^[A-Z]{3}-[0-9]{3}$/'

// Boolean
'true' => 'boolean'

// Confirmed (field matching)
'password' => 'confirmed:password'
```

#### 2. Configurable Message Separator

```php
// Default: HTML line breaks
$validator = new GreenValidator();
$result = $validator->validate([...])->execute();
// Messages separated by <br>

// Change to newlines for CLI
$validator = new GreenValidator();
$validator->setMessageSeparator("\n");
$result = $validator->validate([...])->execute();
// Messages separated by \n
```

#### 3. Helper Methods

```php
// Check if validation passed
if ($validator->passes()) { /* ... */ }

// Check if validation failed
if ($validator->fails()) { /* ... */ }

// Get error array
$errors = $validator->getErrors();
```

### Installation

#### With Composer (Recommended)

```bash
composer require dedsecteam17/green-validator
```

#### Manual Installation

Download the files and include them:

```php
require_once 'vendor/autoload.php';
// or
require_once 'src/GreenValidator.php';
require_once 'src/Validation.php';
```

### PHP Version Requirements

- **Minimum**: PHP 8.1
- **Recommended**: PHP 8.3+

If you're using an older PHP version, stick with 1.x.

### Testing

Run the included test suite:

```bash
composer install
./vendor/bin/phpunit
```

### Need Help?

- Check the [README.md](README.md) for comprehensive examples
- Review [CHANGELOG.md](CHANGELOG.md) for all changes
- Open an issue on GitHub for questions

### Security Note

When validating sensitive data (like passwords), the error messages will include the actual value by default. This is intentional for debugging but consider:

1. Not logging validation errors for sensitive fields
2. Using generic field names in production
3. Sanitizing error messages before displaying to users

Example:

```php
// Instead of this (exposes password in error message):
$result = $validator->validate([
    'mySecretPassword123' => 'required|min:8'
])->execute();

// Consider using field names:
$result = $validator->validate([
    $_POST['password'] => 'required|min:8'
])->execute();

// Or better yet, validate structure not content for passwords:
if (strlen($_POST['password']) >= 8) {
    // proceed with authentication
}
```

### Breaking Changes

**None!** Version 2.0 is fully backward compatible.

### Deprecations

None at this time. The old non-namespaced API will be supported for the foreseeable future.
