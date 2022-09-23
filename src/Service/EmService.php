<?php

namespace App\Service;

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;

class EmService
{
    protected array $paths;
    protected bool $isDevMode = true;
    protected array $dbParams;
    protected $config;

    public function __construct()
    {
        $this->paths = array(dirname(__DIR__).'/Entity/');
        
        $this->dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'scandiweb',
        );
        $this->config = ORMSetup::createAnnotationMetadataConfiguration($this->paths, $this->isDevMode);
    }

    public function initEntityManager(): EntityManager
    {
        $entityManager = EntityManager::create($this->dbParams, $this->config);
        
        return $entityManager;
    }
}
