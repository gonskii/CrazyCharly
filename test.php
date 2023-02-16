<?php

require_once 'vendor/autoload.php';

use teamiut\tables\Participe as Participe;
use teamiut\db\ConnectionFactory as ConnectionFactory;

ConnectionFactory::setConfig();

//print the content of Participe table using the populateParticipe function
$participe = new Participe();
$participe->populateParticipe();
echo $participe;
