<?php
declare(strict_types=1);

use teamiut\db\ConnectionFactory;
use teamiut\dispatch\Dispatcher;

require_once 'vendor/autoload.php';

ConnectionFactory::setConfig();

session_start();


$html = '';
$dispatch = new Dispatcher();
$html .= $dispatch->dispatch();



echo $html;
