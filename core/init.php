<?php
declare(strict_types=1);
global $initType;

use Core\initial\CAPP;
use Core\initial\ECApplicationType;

ob_start("ob_gzhandler");
error_reporting(E_ALL);
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/core/modules/Core/initial/loader.php";
new CAPP(ECApplicationType::from($initType));

//echo CAPP::$SITE;

// move this into the controller
//if (isset($_POST['dataGroup']))
//    require_once(ABSPATH. 'controllers/'.$_POST['dataGroup'].'_excecutor.php');