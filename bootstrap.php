<?php

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;

require_once 'vendor/autoload.php';

$paths = array(dirname(__FILE__) . '/src/Entity/Product/');

$isDevMode = true;

$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'scandiweb',
);

$config = ORMSetup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
