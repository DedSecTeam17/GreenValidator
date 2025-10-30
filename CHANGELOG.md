# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2024-10-30

### Added
- **Modern PHP 8.1+ Support** - Full compatibility with PHP 8.1, 8.2, and 8.3
- **Composer Support** - Added `composer.json` with PSR-4 autoloading
- **Namespaced Classes** - New `GreenValidator\` namespace for better organization
- **20+ Validation Rules** including:
  - `alpha` - Letters only validation
  - `alphanumeric` - Alphanumeric validation
  - `url` - URL validation
  - `ip`, `ipv4`, `ipv6` - IP address validation
  - `json` - JSON format validation
  - `date` with custom format support
  - `boolean` - Boolean validation
  - `required` - Required field validation
  - `between:min,max` - Range validation
  - `in:val1,val2` - Enum validation
  - `regex:/pattern/` - Custom regex validation
  - `confirmed` - Field matching validation
- **Type Safety** - Strict type declarations throughout
- **Property Types** - Modern PHP property type declarations
- **Match Expressions** - Using modern PHP match syntax
- **PHPUnit Tests** - Comprehensive test suite (34 tests, 101 assertions)
- **Modern Examples** - `ModernExample.php` demonstrating all features
- **Documentation** - Extensive README with examples for all validation rules
- **MIT License** - Added LICENSE file

### Changed
- **Code Structure** - Reorganized into `src/` directory with PSR-4 structure
- **Error Messages** - Improved and more consistent error messages
- **Validation Methods** - Enhanced with proper type hints and return types
- **README** - Complete rewrite with comprehensive documentation
- **.gitignore** - Updated to exclude vendor and cache directories

### Improved
- **Performance** - Using native PHP functions where possible
- **Email Validation** - Now uses `filter_var()` for more reliable validation
- **Code Quality** - Strict types and proper error handling
- **Backward Compatibility** - Old non-namespaced API still works perfectly

### Backward Compatible
- All existing code continues to work without modifications
- Old `GreenValidator` and `Validation` classes maintained as wrappers
- Existing validation rules behave identically
- Same API for `validate()` and `execute()` methods

### Testing
- PHPUnit 10.5 test suite added
- 34 comprehensive tests covering all validation rules
- 101 assertions ensuring correct behavior
- Tests for both new and legacy API

### Developer Experience
- Modern IDE autocomplete support
- Type hints for better code intelligence
- Comprehensive inline documentation
- Clear error messages

## [1.0.0] - 2018-12-16

### Initial Release
- Basic email validation
- Number validation
- String validation
- Float validation
- Min/max length validation
- Pipe-separated rule syntax
- Simple error messaging
