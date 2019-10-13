<?php


namespace App\Services;


use Doctrine\ORM\EntityManagerInterface;

class ServiceManagerConfigurator
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function configure(ServiceManager $sericesManager)
    {
        $sericesManager->setEntityManager($this->em);
    }

}