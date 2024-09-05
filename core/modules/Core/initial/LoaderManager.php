<?php

namespace Core\initial;

use Core\initial\Classes\BaseLoader;
use Core\initial\exceptions\ApplicationTypeException;
use Core\initial\exceptions\ExceptionLevel;
use Core\initial\exceptions\ManagerLoadedException;

class LoaderManager {

    private BaseLoader $loader;
    
    /**
     * Select the loader that is required for the request
     * @throws ApplicationTypeException thrown when the Application type that is passed is not recognized
     */
    private function __construct(ECApplicationType $appType) {
        switch ($appType) { // TODO: implement the loaders functionality
            case ECApplicationType::AJAX:break;
            case ECApplicationType::CMD:break;
            case ECApplicationType::CRON:break;
            case ECApplicationType::MEDIA:break;
            case ECApplicationType::REST:break;
            case ECApplicationType::WEB:break;
            default: throw new ApplicationTypeException('Core', 'LoaderManager', ExceptionLevel::ERROR, 'Invalid application type:'.$appType->value, 1);
        }
    }
    /**
     * Initiate the class
     * @throws ManagerLoadedException thrown when the manager is already loaded into the CAPP class
     * @throws ApplicationTypeException thrown when the Application type that is passed is not recognized
     */
    public static function init(ECApplicationType $appType): self {
        if (isset(CAPP::$LOADER)) throw new ManagerLoadedException('Core', 'LoaderManager', ExceptionLevel::ERROR, "LoaderManager is already loaded", 1);
        return new self($appType);
    }
}