<?php

namespace Core\initial\exceptions;

enum XExceptionType: string {
    case CONSTRUCTION = 'ET_C';
    case RUNTIME = 'ET_R';
    
    public function label(): string {
        return match ($this) {
            self::CONSTRUCTION => 'Construction exception',
            self::RUNTIME      => 'Runtime exception',
        };
    }
}