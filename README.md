 # GreenValidator 🌱

![GitHub Logo](leaf.png)

A modern PHP validation library with support for complex validation rules. Built for PHP 8.1+ with type safety and comprehensive validation capabilities.

## ✨ Features

- **Modern PHP 8.1+** - Uses strict types, property types, and modern PHP features
- **20+ Validation Rules** - Email, URL, IP addresses, JSON, dates, and more
- **Complex Validations** - Chain multiple rules together
- **Type Safe** - Full type declarations throughout
- **PSR-4 Autoloading** - Composer-ready with proper namespacing
- **Fully Tested** - Comprehensive PHPUnit test coverage
- **Backward Compatible** - Works with existing code

## 📦 Installation

### Using Composer (Recommended)

```bash
composer require dedsecteam17/green-validator
```

### Manual Installation

Clone the repository or download the files and include them in your project:

```php
require_once 'vendor/autoload.php';
// Or for manual installation:
require_once 'src/GreenValidator.php';
require_once 'src/Validation.php';
```

## 🚀 Quick Start

```php
use GreenValidator\GreenValidator;

$validator = new GreenValidator();

$result = $validator->validate([
    'john.doe@example.com' => 'email',
    'John Doe' => 'string|min:6|max:150',
    'https://example.com' => 'url',
    '25' => 'number|between:18,100',
])->execute();

if ($result->isValid()) {
    echo 'Validation passed!';
} else {
    echo $result->getMessage();
}
```

## 📖 Available Validation Rules

### Basic Data Types
- **`email`** - Valid email address
- **`number`** - Integer numbers only
- **`float`** - Floating point numbers
- **`string`** - Alphanumeric strings with spaces
- **`boolean`** - Boolean values (true, false, 1, 0, "true", "false")

### String Validations
- **`alpha`** - Letters only (with spaces)
- **`alphanumeric`** - Letters and numbers (no spaces)
- **`min:n`** - Minimum length of n characters
- **`max:n`** - Maximum length of n characters

### Internet & Network
- **`url`** - Valid URL
- **`ip`** - Valid IP address (IPv4 or IPv6)
- **`ipv4`** - Valid IPv4 address
- **`ipv6`** - Valid IPv6 address

### Data Formats
- **`json`** - Valid JSON string
- **`date`** - Valid date (default format: Y-m-d)
- **`date:format`** - Valid date with custom format (e.g., `date:d/m/Y`)

### Advanced Rules
- **`required`** - Field must not be empty
- **`between:min,max`** - Numeric value between min and max
- **`in:val1,val2,val3`** - Value must be in the list
- **`regex:/pattern/`** - Custom regex pattern matching

## 💡 Usage Examples

### Basic Validation

```php
use GreenValidator\GreenValidator;

$validator = new GreenValidator();

$result = $validator->validate([
    'test@example.com' => 'email',
    '12345' => 'number',
    'Hello World' => 'string',
])->execute();

if ($result->isValid()) {
    echo 'All validations passed!';
}
```

### String Length Validation

```php
$validator = new GreenValidator();

$result = $validator->validate([
    'John Doe' => 'string|min:5|max:20',
    'user123' => 'alphanumeric|min:3|max:15',
])->execute();
```

### URL and IP Validation

```php
$validator = new GreenValidator();

$result = $validator->validate([
    'https://github.com' => 'url',
    '192.168.1.1' => 'ipv4',
    '2001:0db8:85a3::7334' => 'ipv6',
])->execute();
```

### Date Validation

```php
$validator = new GreenValidator();

$result = $validator->validate([
    '2024-01-15' => 'date',                    // Y-m-d format
    '15/01/2024' => 'date:d/m/Y',             // Custom format
    '01-15-2024' => 'date:m-d-Y',             // US format
])->execute();
```

### JSON Validation

```php
$validator = new GreenValidator();

$jsonData = '{"name":"John","age":30}';
$result = $validator->validate([
    $jsonData => 'json',
])->execute();
```

### Range Validation

```php
$validator = new GreenValidator();

$result = $validator->validate([
    '25' => 'number|between:18,65',      // Age between 18 and 65
    '7.5' => 'float|between:0,10',       // Rating between 0 and 10
])->execute();
```

### Enum (In) Validation

```php
$validator = new GreenValidator();

$result = $validator->validate([
    'active' => 'in:active,inactive,pending',
    'admin' => 'in:admin,user,guest',
])->execute();
```

### Custom Regex Validation

```php
$validator = new GreenValidator();

$result = $validator->validate([
    'ABC-123' => 'regex:/^[A-Z]{3}-[0-9]{3}$/',  // License plate format
    '+1-234-567-8900' => 'regex:/^\+\d{1}-\d{3}-\d{3}-\d{4}$/',  // Phone format
])->execute();
```

### Required Fields

```php
$validator = new GreenValidator();

$result = $validator->validate([
    'John Doe' => 'required|string',
    'john@example.com' => 'required|email',
    '25' => 'required|number',
])->execute();
```

### Complex Multi-Rule Validation

```php
$validator = new GreenValidator();

$result = $validator->validate([
    'john.doe@example.com' => 'required|email',
    'JohnDoe123' => 'required|alphanumeric|min:6|max:20',
    'https://example.com' => 'required|url',
    '25' => 'required|number|between:18,100',
    '2024-01-15' => 'required|date',
    'active' => 'required|in:active,inactive,pending',
])->execute();

if ($result->isValid()) {
    echo 'All validations passed!';
} else {
    echo 'Validation errors:<br>' . $result->getMessage();
}
```

## 🔄 Backward Compatibility

The library maintains full backward compatibility with the original API:

```php
// Old non-namespaced usage still works
require_once 'GreenValidator.php';

$validator = new GreenValidator();

$result = $validator->validate([
    'Mohammed Elamin' => 'string|min:6|max:15',
    'mohammed@ahoo.com' => 'email',
    '2019' => 'number',
])->execute();

if ($result->getisValid()) {
    echo 'validated successfully';
} else {
    echo $result->getMessage();
}
```

## 🧪 Testing

The library includes comprehensive PHPUnit tests:

```bash
composer install
./vendor/bin/phpunit
```

## 📝 API Reference

### GreenValidator Methods

#### Validation Methods
- `validate(array $requests): self` - Main validation method
- `execute(): Validation` - Execute validation and return result
- `passes(): bool` - Check if validation passed
- `fails(): bool` - Check if validation failed
- `getErrors(): array` - Get array of error messages

#### Individual Validators
- `isEmail(mixed $email): bool`
- `isNumber(mixed $num): bool`
- `isFloat(mixed $float): bool`
- `isStringOnly(mixed $str): bool`
- `isAlpha(mixed $str): bool`
- `isAlphaNumeric(mixed $str): bool`
- `isUrl(mixed $url): bool`
- `isIp(mixed $ip): bool`
- `isIpv4(mixed $ip): bool`
- `isIpv6(mixed $ip): bool`
- `isJson(mixed $str): bool`
- `isDate(mixed $date, string $format = 'Y-m-d'): bool`
- `isBoolean(mixed $value): bool`
- `isRequired(mixed $value): bool`
- `isIn(mixed $value, array $allowed): bool`
- `isBetween(mixed $value, float|int $min, float|int $max): bool`
- `isConfirmed(mixed $value, mixed $confirmValue): bool`
- `matchesRegex(mixed $value, string $pattern): bool`
- `min(mixed $data, int $min): bool`
- `max(mixed $data, int $max): bool`

### Validation Methods
- `isValid(): bool` - Check if validation passed
- `failed(): bool` - Check if validation failed
- `getMessage(): string` - Get error message(s)
- `getIsValid(): bool` - Alias for isValid()

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

MIT License - feel free to use this in your projects!

## 🔖 Version

**2.0.0** - Modern PHP 8.1+ with complex validation support

### What's New in 2.0
- ✅ PHP 8.1+ with strict types
- ✅ PSR-4 autoloading with Composer
- ✅ 20+ validation rules
- ✅ Comprehensive test coverage
- ✅ Modern PHP features (property types, match expressions)
- ✅ Backward compatible with 1.x

## 👨‍💻 Author

Mohammed Elamin - DedSecTeam17

---

**Need help?** Feel free to open an issue on GitHub! 🌱
