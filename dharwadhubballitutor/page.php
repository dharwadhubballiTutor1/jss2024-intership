<?php
session_start();
//include('header.php');

require_once   'src/Core/helpers.php';
spl_autoload_register('phpb_autoload');

$config =  'config.php';
$config=include $config;
$builder = new PHPageBuilder\PHPageBuilder($config);
$builder->handleRequest();

?>