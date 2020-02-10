<?php

namespace App\Repository;

use App\Entity\Superadmin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Superadmin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Superadmin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Superadmin[]    findAll()
 * @method Superadmin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuperadminRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Superadmin::class);
    }

    // /**
    //  * @return Superadmin[] Returns an array of Superadmin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Superadmin
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
