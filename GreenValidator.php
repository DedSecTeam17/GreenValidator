<?php
/**
 * Legacy GreenValidator wrapper for backward compatibility
 * 
 * This file provides backward compatibility with the old API.
 * For new projects, use the namespaced version: GreenValidator\GreenValidator
 * 
 * @deprecated Use GreenValidator\GreenValidator instead
 */

// Load the new namespaced version
require_once __DIR__ . '/src/GreenValidator.php';
require_once __DIR__ . '/src/Validation.php';

use GreenValidator\GreenValidator as ModernGreenValidator;
use GreenValidator\Validation as ModernValidation;

/**
 * Legacy GreenValidator class
 * 
 * Provides backward compatibility with the old non-namespaced API
 */
class GreenValidator extends ModernGreenValidator
{
    // This class now inherits all methods from the modern implementation
    // and provides full backward compatibility
}

/**
 * Legacy Validation class
 * 
 * Provides backward compatibility with the old non-namespaced API
 */
class Validation extends ModernValidation
{
    // This class now inherits all methods from the modern implementation
    // and provides full backward compatibility
}







