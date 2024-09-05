<?php

namespace Core\initial\exceptions;

use Core\initial\CAPP;
use Core\initial\Classes\ExceptionEnum;
use Throwable;

class ConstructionException extends ExceptionHandler {

    protected const XExceptionType exceptionType = XExceptionType::CONSTRUCTION;

    public function __construct(string $module, string $component, ExceptionEnum $enum, string $message = "", int $code = 0, ?Throwable $previous = NULL) {
        parent::__construct($module, $component, ExceptionLevel::ERROR, $message, $code, $previous);
        echo "<pre>";
        echo "[".get_class($this).']'.PHP_EOL;
        echo $module.":".$component.":".CAPP::$LANG->getEnumLabel($enum).PHP_EOL;
        echo $message;
        echo $this->getTraceAsString();
        echo "</pre>";
    }
}