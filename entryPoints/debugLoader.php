<?php
declare(strict_types=1);
$initType = "CMD";
$_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__, 2);
$_SERVER['SERVER_NAME'] = 'test.site';
require $_SERVER['DOCUMENT_ROOT']."/core/init.php";