<?php

namespace Core\initial\exceptions;

use Throwable;

/**
 * the class that adds functions to our Exception classes
 */
abstract class ExceptionHandler extends \Exception {

    private string $module;
    private string $component;
    private ExceptionLevel  $enum;
    
    /**
     * @param string $module
     * @param string $component
     * @param ExceptionLevel $enum
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $module, string $component, ExceptionLevel $enum, string $message = "", int $code = 0, ?Throwable $previous = NULL) {
        parent::__construct($message, $code, $previous);
        $this->module = $module;
        $this->component = $component;
        $this->enum = $enum;
        echo $module.':'.$component.':'.$enum->value.':'.$message.$this->getTraceAsString();
    }

    protected function addToLog() {
        // TODO: implement this
    }
}