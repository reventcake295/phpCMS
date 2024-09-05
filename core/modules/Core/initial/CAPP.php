<?php

namespace Core\initial;
use Core\initial\Classes\CDatabase;
use Core\initial\Classes\CLANG;
use Core\initial\Classes\CUSER;
use Core\initial\Classes\Provider;
use Core\initial\exceptions\ApplicationTypeException;
use Core\initial\exceptions\ManagerLoadedException;
use Core\initial\Providers\js_Provider;
use JetBrains\PhpStorm\NoReturn;

final class CAPP {
    public static Array $output;
    public static string            $SITE;
    public static ECApplicationType $appType;
    public static LoaderManager     $LOADER;
    public static log_Provider      $LOG;

    public static Provider $Providers;
    public static CUSER $USER;
    public static CLANG $LANG;
    public static js_Provider $JS;
    public static CDatabase $DATABASE;
    
    private bool $debug = TRUE;
    
    public function __construct(ECApplicationType $appType) {
        self::$appType = $appType;

        try {
            self::$LOG = log_Provider::init($this->debug);
            self::$LOADER = LoaderManager::init(self::$appType);
            
//            self::$LANG = managers\CLANG::init($this->defaultLang);
//            self::$JS = managers\JsManager::init();

//            self::$USER = managers\CUSER::load();
//            self::$DATABASE = managers\DatabaseManager::load();
        } catch (ManagerLoadedException $e) {

        } catch (ApplicationTypeException $e) {
        }
    }
    
    public static function loadProvider(string $provider): bool {
        
        // TODO: impelment this along with the rest of the provider system
        return false;
    }
    
    public static function loadModule(string $module): bool {
        // TODO: impelment this along with the rest of the module system
        return false;
    }
    #[NoReturn] public static function terminate($code = 0): void {


        exit($code);
    }
}