<?php

namespace Core\initial\exceptions;

use Core\initial\CAPP;

/**
 * List of Enum cases for use in the exception UnexpectedUriTokenException
 * @see UnexpectedUriTokenException
 */
enum XEUriTokenError: string  implements \Core\initial\Classes\ExceptionEnum {
    
    /** Used when an '_' was found */
    case UNDERSCORE = 'XEUriTokenError_';
    
    /** Used when '..' is found */
    case DOUBLE_DOT = 'XEUriTokenError_DOUBLE_DOT';
    
    /** When '.' is found */
    case ERROR_DOT = 'XEUriTokenError_DOT';
    
    /** When 'secure' is found */
    case ERROR_SECURE = 'XEUriTokenError_SECURE';
    
    /**  When a wrapper is detected */
    case ERROR_WRAPPER = 'XEUriTokenError_WRAPPER';
    
    /** When a phar wrapper is detected */
    case ERROR_WRAPPER_PHAR = 'XEUriTokenError_PHAR_WRAPPER';
    
    public function label(): string {
        return CAPP::$LANG->getEnumLabel($this);
    }
    
    public static function labels(): array {
        return CAPP::$LANG->getEnumLabels('XEUriTokeError');
    }
}