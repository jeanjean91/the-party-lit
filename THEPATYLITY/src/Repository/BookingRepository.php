<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    // /**
    //  * @return Booking[] Returns an array of Booking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Booking
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @return local[] Returns an array of local objects
     */
    public function findByuserBook($user):array
    {
        $connect =$this->createQueryBuilder('e')

            ->andWhere('e.user = :user')
            ->setParameter('user', $user)

            /* ->setMaxResults()*/
            ->getQuery();
        /* ->getResult()*/

        return $connect ->execute();

    }

    public function findBySalle($salle):array
    {
        $connect =$this->createQueryBuilder('e')

            ->andWhere('e.salle = :salle')
            ->setParameter('salle', $salle)

            /* ->setMaxResults()*/
            ->getQuery();
        /* ->getResult()*/

        return $connect ->execute();

    }

    public function findByBook ()
    {
        $entityManager = $this ->getEntityManager();

        $connect= $entityManager ->createQuery(    " 
            SELECT  distinct COUNT( e.id) as total
             FROM App\Entity\Booking e
             WHERE e.id = e.id
             ") ;




        return $connect ->execute();
    }
}
