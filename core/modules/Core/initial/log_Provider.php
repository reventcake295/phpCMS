<?php

namespace Core\initial;


use Core\initial\Classes\Provider;
use Core\initial\exceptions\ManagerLoadedException;

class log_Provider extends Provider {
    private bool $debug;
    private function __construct(bool $debug) {
        $this->debug = $debug;
    }
    /**
     * Initiate the class
     * @throws ManagerLoadedException thrown when the Provider is already loaded into the CAPP class
     */
    public static function init(bool $debug): self {
        if (isset(CAPP::$LOG)) throw new ManagerLoadedException(); // TODO: rewrok this into a provider loaded exception
        return new self($debug);
    }
    
    public function logFileAccessError(\Throwable $exception, string $origin, string $problem): void {
    
    }
    //TODO fill in this class
}

//class txtStorage {
//    private $Files = ['database'=>FILES['ERRORS']."database.err"];
//
//    public function txtStorage() {
//        return $this;
//    }
//    public function errors() {
//        $this->databaseError();
//    }
//
//    private function databaseError() {
//        global $language;
//        if ($language->errorIsset('database')) {
//            $databaseErrorFile = fopen($this->Files['database'], 'a+');
//            fwrite($databaseErrorFile, 'action: '.$language->errors['database'][0]."\n time: ".date("Y-m-d H:i:s:u"). "\n debugInfo: ".$language->errors['database'][1]);
//            fclose($databaseErrorFile);
//        }
//        return;
//    }
//
//    public function getErrors() {
//        $this->getDatabaseErrors();
//    }
//
//    private function getDataBaseErrors() {
//        $databaseErrors = [];
//        if (file_exists($this->Files['database'])) {
//            $databaseErrorFile = fopen($this->Files['database'], 'r');
//            while (!feof($databaseErrorFile)) {
//
//            }
//        }
//        return $databaseErrors;
//    }
//    //the array setup
//    //['database']
//    //  [errorName]
//    //    [date]
//    //      [debug]
//    //
//}