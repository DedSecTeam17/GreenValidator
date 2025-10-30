<?php

declare(strict_types=1);

namespace GreenValidator;

/**
 * GreenValidator - Modern PHP validation library
 * 
 * A comprehensive validation library supporting various data types and complex validation rules
 */
class GreenValidator
{
    private array $validationResult = [];

    /**
     * Validate if value is a number
     */
    public function isNumber(mixed $num): bool
    {
        return is_numeric($num) && preg_match('/^[0-9]+$/', (string)$num) === 1;
    }

    /**
     * Validate if value is a float
     */
    public function isFloat(mixed $float): bool
    {
        return filter_var($float, FILTER_VALIDATE_FLOAT) !== false;
    }

    /**
     * Validate if value is an email
     */
    public function isEmail(mixed $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validate if value is a string (alphanumeric with spaces)
     */
    public function isStringOnly(mixed $str): bool
    {
        return preg_match("/^[a-zA-Z0-9 ]+$/", (string)$str) === 1;
    }

    /**
     * Validate if value contains only letters
     */
    public function isAlpha(mixed $str): bool
    {
        return preg_match("/^[a-zA-Z ]+$/", (string)$str) === 1;
    }

    /**
     * Validate if value is alphanumeric
     */
    public function isAlphaNumeric(mixed $str): bool
    {
        return preg_match("/^[a-zA-Z0-9]+$/", (string)$str) === 1;
    }

    /**
     * Validate if value is a valid URL
     */
    public function isUrl(mixed $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Validate if value is a valid IP address
     */
    public function isIp(mixed $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * Validate if value is a valid IPv4 address
     */
    public function isIpv4(mixed $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }

    /**
     * Validate if value is a valid IPv6 address
     */
    public function isIpv6(mixed $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }

    /**
     * Validate if value is valid JSON
     */
    public function isJson(mixed $str): bool
    {
        if (!is_string($str)) {
            return false;
        }
        json_decode($str);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Validate if value is a valid date
     */
    public function isDate(mixed $date, string $format = 'Y-m-d'): bool
    {
        if (!is_string($date)) {
            return false;
        }
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    /**
     * Validate if value is a boolean
     */
    public function isBoolean(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null;
    }

    /**
     * Validate if value matches regex pattern
     */
    public function matchesRegex(mixed $value, string $pattern): bool
    {
        return preg_match($pattern, (string)$value) === 1;
    }

    /**
     * Validate maximum length
     */
    public function max(mixed $data, int $max): bool
    {
        return strlen((string)$data) <= $max;
    }

    /**
     * Validate minimum length
     */
    public function min(mixed $data, int $min): bool
    {
        return strlen((string)$data) >= $min;
    }

    /**
     * Validate if value is required (not empty)
     */
    public function isRequired(mixed $value): bool
    {
        if (is_null($value)) {
            return false;
        }
        if (is_string($value) && trim($value) === '') {
            return false;
        }
        if (is_array($value) && empty($value)) {
            return false;
        }
        return true;
    }

    /**
     * Validate if value is in a list of allowed values
     */
    public function isIn(mixed $value, array $allowed): bool
    {
        return in_array($value, $allowed, true);
    }

    /**
     * Validate if numeric value is between min and max
     */
    public function isBetween(mixed $value, float|int $min, float|int $max): bool
    {
        if (!is_numeric($value)) {
            return false;
        }
        $numValue = (float)$value;
        return $numValue >= $min && $numValue <= $max;
    }

    /**
     * Validate if two values match (useful for password confirmation)
     */
    public function isConfirmed(mixed $value, mixed $confirmValue): bool
    {
        return $value === $confirmValue;
    }

    /**
     * Main validation method
     * 
     * @param array<mixed, string> $requests Array where keys are values to validate and values are validation rules
     * @return self Returns $this for method chaining
     */
    public function validate(array $requests): self
    {
        foreach ($requests as $data => $rules) {
            $ruleArray = explode('|', $rules);
            
            foreach ($ruleArray as $rule) {
                $this->applyRule($data, $rule);
            }
        }

        return $this;
    }

    /**
     * Apply a single validation rule
     */
    private function applyRule(mixed $data, string $rule): void
    {
        // Handle rules with parameters (e.g., min:6, max:10)
        if (str_contains($rule, ':')) {
            [$ruleName, $params] = explode(':', $rule, 2);
            $this->applyParameterizedRule($data, $ruleName, $params);
            return;
        }

        // Handle simple rules without parameters
        $this->applySimpleRule($data, $rule);
    }

    /**
     * Apply a rule with parameters
     */
    private function applyParameterizedRule(mixed $data, string $ruleName, string $params): void
    {
        match ($ruleName) {
            'min' => $this->min($data, (int)$params) 
                ?: array_push($this->validationResult, "$data must be at least $params characters"),
            'max' => $this->max($data, (int)$params) 
                ?: array_push($this->validationResult, "$data must be at most $params characters"),
            'between' => $this->validateBetween($data, $params),
            'in' => $this->validateIn($data, $params),
            'regex' => $this->matchesRegex($data, $params) 
                ?: array_push($this->validationResult, "$data does not match required pattern"),
            'date' => $this->isDate($data, $params) 
                ?: array_push($this->validationResult, "$data is not a valid date with format $params"),
            'confirmed' => null, // Requires special handling with two fields
            default => array_push($this->validationResult, "Unknown validation rule: $ruleName")
        };
    }

    /**
     * Apply a simple rule without parameters
     */
    private function applySimpleRule(mixed $data, string $rule): void
    {
        match ($rule) {
            'email' => $this->isEmail($data) 
                ?: array_push($this->validationResult, "$data is not a valid email"),
            'string' => $this->isStringOnly($data) 
                ?: array_push($this->validationResult, "$data is not a valid string"),
            'number' => $this->isNumber($data) 
                ?: array_push($this->validationResult, "$data is not a valid number"),
            'float' => $this->isFloat($data) 
                ?: array_push($this->validationResult, "$data is not a valid float"),
            'alpha' => $this->isAlpha($data) 
                ?: array_push($this->validationResult, "$data must contain only letters"),
            'alphanumeric' => $this->isAlphaNumeric($data) 
                ?: array_push($this->validationResult, "$data must be alphanumeric"),
            'url' => $this->isUrl($data) 
                ?: array_push($this->validationResult, "$data is not a valid URL"),
            'ip' => $this->isIp($data) 
                ?: array_push($this->validationResult, "$data is not a valid IP address"),
            'ipv4' => $this->isIpv4($data) 
                ?: array_push($this->validationResult, "$data is not a valid IPv4 address"),
            'ipv6' => $this->isIpv6($data) 
                ?: array_push($this->validationResult, "$data is not a valid IPv6 address"),
            'json' => $this->isJson($data) 
                ?: array_push($this->validationResult, "$data is not valid JSON"),
            'date' => $this->isDate($data) 
                ?: array_push($this->validationResult, "$data is not a valid date"),
            'boolean' => $this->isBoolean($data) 
                ?: array_push($this->validationResult, "$data is not a valid boolean"),
            'required' => $this->isRequired($data) 
                ?: array_push($this->validationResult, "$data is required"),
            default => null // Ignore unknown rules silently
        };
    }

    /**
     * Validate between rule
     */
    private function validateBetween(mixed $data, string $params): void
    {
        $range = explode(',', $params);
        if (count($range) !== 2) {
            array_push($this->validationResult, "Invalid between rule format");
            return;
        }
        
        $min = (float)trim($range[0]);
        $max = (float)trim($range[1]);
        
        if (!$this->isBetween($data, $min, $max)) {
            array_push($this->validationResult, "$data must be between $min and $max");
        }
    }

    /**
     * Validate in rule
     */
    private function validateIn(mixed $data, string $params): void
    {
        $allowed = array_map('trim', explode(',', $params));
        
        if (!$this->isIn($data, $allowed)) {
            $allowedStr = implode(', ', $allowed);
            array_push($this->validationResult, "$data must be one of: $allowedStr");
        }
    }

    /**
     * Execute validation and return result
     */
    public function execute(): Validation
    {
        $validation = new Validation();

        if (count($this->validationResult) > 0) {
            $message = implode('<br>', $this->validationResult);
            $validation->setMessage($message);
            $validation->setIsValid(false);
        } else {
            $validation->setIsValid(true);
        }

        return $validation;
    }

    /**
     * Get validation errors
     */
    public function getErrors(): array
    {
        return $this->validationResult;
    }

    /**
     * Check if validation has passed
     */
    public function passes(): bool
    {
        return empty($this->validationResult);
    }

    /**
     * Check if validation has failed
     */
    public function fails(): bool
    {
        return !empty($this->validationResult);
    }
}
