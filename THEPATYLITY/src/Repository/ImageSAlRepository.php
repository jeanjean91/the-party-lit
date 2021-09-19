<?php

namespace App\Repository;

use App\Entity\ImageSAl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ImageSAl|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageSAl|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageSAl[]    findAll()
 * @method ImageSAl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageSAlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageSAl::class);
    }

    // /**
    //  * @return ImageSAl[] Returns an array of ImageSAl objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageSAl
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */





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
