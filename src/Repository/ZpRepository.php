<?php

namespace App\Repository;

use App\Entity\Zp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Zp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zp[]    findAll()
 * @method Zp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZpRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Zp::class);
    }

    // /**
    //  * @return Zp[] Returns an array of Zp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zp
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
