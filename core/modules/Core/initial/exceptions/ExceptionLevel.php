<?php

namespace Core\initial\exceptions;

use Core\initial\Classes\ExceptionEnum;

enum ExceptionLevel: string implements ExceptionEnum {
    case DEBUG = 'debug';
    case INFO = 'info';
    case NOTICE = 'notice';
    case WARNING = 'warning';
    case ERROR = 'error';
}