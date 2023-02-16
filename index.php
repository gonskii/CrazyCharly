<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use teamiut\db\ConnectionFactory;
use teamiut\dispatch\Dispatcher;

session_start();


$html = '';
$dispatch = new Dispatcher();
$html .= $dispatch->dispatch();



echo $html;
