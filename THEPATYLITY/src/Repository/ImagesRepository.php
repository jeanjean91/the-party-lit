<?php

namespace App\Repository;

use App\Entity\Images;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


/**
 * @method Images|null find($id, $lockMode = null, $lockVersion = null)
 * @method Images|null findOneBy(array $criteria, array $orderBy = null)
 * @method Images[]    findAll()
 * @method Images[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Images::class);
    }

    // /**
    //  * @return Images[] Returns an array of Images objects
    //  */

    /* public function findByExampleField($value)
     {
         $connect = $this->createQueryBuilder('i')
             ->andWhere('i.projet = :projet')
             ->setParameter('projet', $value)
             ->orderBy('i.id', 'ASC')
             ->setMaxResults(10)
             ->getQuery()

         ;
         return $connect ->execute();
     }

     // /**
     //  * @return Images[] Returns an array of Images objects
     //  */

    /*
      public function findByExampleField($value): array
      {
            $connect =$this->createQueryBuilder('i');
          $entityManager = $this->getEntityManager();
          $connect= $entityManager ->createQuery("
           SELECT('i.name')
            FROM App\Entity\Images i
              WHERE i.projet = $value");
          return $connect->execute();
      }*/

    // /**
    //  * @return Images[] Returns an array of Images objects
    //  */

    public function findByExampleField($salle): array
    {

        $connect =$this->createQueryBuilder('i')
            ->select('i.name')
            ->andWhere('i.salle = :salle')
            ->setParameter('salle', $salle)
            ->getQuery();

        return $connect ->execute();
    }

}
