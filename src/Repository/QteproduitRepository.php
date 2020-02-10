<?php

namespace App\Repository;

use App\Entity\Qteproduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Qteproduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Qteproduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Qteproduit[]    findAll()
 * @method Qteproduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QteproduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Qteproduit::class);
    }

    // /**
    //  * @return Qteproduit[] Returns an array of Qteproduit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Qteproduit
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
