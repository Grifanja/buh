<?php

namespace App\Repository;

use App\Entity\Esv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Esv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Esv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Esv[]    findAll()
 * @method Esv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EsvRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Esv::class);
    }

    // /**
    //  * @return Esv[] Returns an array of Esv objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Esv
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
