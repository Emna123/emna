<?php

namespace App\Repository;

use App\Entity\Admini;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Admini|null find($id, $lockMode = null, $lockVersion = null)
 * @method Admini|null findOneBy(array $criteria, array $orderBy = null)
 * @method Admini[]    findAll()
 * @method Admini[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Admini::class);
    }
/*
       public function rech(Admini $c){
           return $this->createQueryBuilder('k')
               ->leftJoin('k.properties','property'  )
               ->where('property.prenom = :propertyPrenom')
               ->setParameter('propertyPrenom', $c ['property']->getPrenom())
               ->andWhere('k.prenom = :prenom')
               ->getQuery()
               ->getResult()
               ;}*/
   /* public function rech( $c)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.prenom = :c')
            ->setParameter('c', $c)
            ->getQuery()
            ->getResult();
    }
   */


   // /**
    // * @return Admini|null Returns an array of Admini objects
   //  */

  /*  public function index ($value)
    {
        return $this->createQueryBuilder('a')


            ->andWhere("a.prenom = :val")
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;*/
/*
        $sql =  "SELECT m.* "
            ."FROM ".Admini::class." AS m "
            ."WHERE".("m.prenom=.$value.");

        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addEntityResult(Admini::class, "m");
        $stmt = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        $stmt->execute([]);

        return $stmt->fetchAll();

    }
*/


   /* public function findOneByPrenom($value): ?Admini
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.prenom = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }*/

}
