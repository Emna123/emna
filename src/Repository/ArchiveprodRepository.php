<?php

namespace App\Repository;

use App\Entity\Archiveprod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Archiveprod|null find($id, $lockMode = null, $lockVersion = null)
 * @method Archiveprod|null findOneBy(array $criteria, array $orderBy = null)
 * @method Archiveprod[]    findAll()
 * @method Archiveprod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArchiveprodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Archiveprod::class);
    }

    // /**
    //  * @return Archiveprod[] Returns an array of Archiveprod objects
    //  */

    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id_com = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Archiveprod
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
