<?php

namespace Core\Providers;

use Core\initial\CAPP;
use Core\initial\Classes\CFiles;
use Core\initial\Classes\Provider;
use Core\initial\exceptions\ExceptionLevel;
use Core\initial\exceptions\ManagerLoadedException;

class js_Provider extends Provider {
    private string $externalJsFiles = "";
    private string $jsFiles = "";
    private string $jsString = "";

    private function __construct()
    {
        $this->addJsFile("global");
    }

    /**
     * Initiate the class
     * @throws ManagerLoadedException thrown when the manager is already loaded into the CAPP class
     */
    public static function init(): self
    {
        if (isset(CAPP::$JS)) throw new ManagerLoadedException('Core', 'JsManager', ExceptionLevel::ERROR, "JsManager is already loaded", 1);
        return new self();
    }

    public function addJsString(string $jsString): void
    {
        $this->jsString .= $jsString;
    }

    public function addJsFile(string $jsFile): bool
    {
        if (!file_exists(CFiles::MEDIA_JS . $jsFile . ".js")) return FALSE;
        $this->jsFiles .= "<script src='" . CAPP::$SITE . "Core/js/" . $jsFile . ",js'></script>";
        return TRUE;
    }

    private function addExternalJsFile(string $externalJsFile): void
    {
        $this->externalJsFiles .= $externalJsFile;
    }

    public function loadJS(): string
    {
        $langKeys = "const langKeys = " . json_encode(CAPP::$LANG->getUsedLangKeys()) . ";";

        return $this->externalJsFiles . $this->jsFiles . "<script>" . $langKeys . $this->jsString . "</script>";
    }
}

//class Js {
//
//    private $script = '<js>
//    <script src="'.SITE.'/js/jquery-1.12.4.min.js"></script>
//    <script src="'.SITE.'/js/main.js"></script>
//    <script src="'.SITE.'/js/easterEgg.js">';
//
//    private $looseLines = '<script>const VERSION = "true Object Oriented version: 1.0";';
//
//    private $form = '<script>function post(path,params,method){method = method || "post";let form = document.createElement("form");form.setAttribute("method", method);form.setAttribute("action", path);for(let key in params){if(params.hasOwnProperty(key)){let hiddenField=document.createElement("input");hiddenField.setAttribute("type","hidden");hiddenField.setAttribute("name",key);hiddenField.setAttribute("value", params[key]);form.appendChild(hiddenField);}}document.body.appendChild(form);form.submit();return;}';
//
//    public function Js() {
//        return;
//    }
//    public function addFile($file) {
//        $this->script = '<script src="'.$file.'"></script><br>';
//    }
//
//    public function addLine($line) {
//        $this->looseLines .= $line;
//    }
//
//    //post(&#39;'.SITE.'/shop?group='.$group.'&#39;, {dataGroup:&#39;shop&#39;, product: &#39;'.$products[$i]['ID'].'&#39;});
//    public function constructForm($target, $params, $method) {
//        $line = 'post("'.$target."{";
//        foreach ($params as $key => $value) {
//            $line .= $key.":'".$value."',";
//        }
//        $line = substr($line, 0, -1)."},".$method.");";
//        $this->form .= $line;
//    }
//
//    public function buildJs() {
//        return $this->form.'</script>'.$this->script.$this->looseLines .= '</script></js>';
//    }
//}