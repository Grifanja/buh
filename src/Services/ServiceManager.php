<?php


namespace App\Services;


use Doctrine\ORM\EntityManagerInterface;

class ServiceManager
{

    private $em;

    public function exec()
    {

        dump($this->em);

    }

    public function setEntityManager( EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

}