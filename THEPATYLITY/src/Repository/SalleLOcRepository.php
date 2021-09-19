<?php

namespace App\Repository;

use App\Entity\SalleLOc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SalleLOc|null find($id, $lockMode = null, $lockVersion = null)
 * @method SalleLOc|null findOneBy(array $criteria, array $orderBy = null)
 * @method SalleLOc[]    findAll()
 * @method SalleLOc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalleLOcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SalleLOc::class);
    }

    // /**
    //  * @return SalleLOc[] Returns an array of SalleLOc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SalleLOc
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
      * @return local[] Returns an array of local objects
      */
    public function findByuserLocal($user):array
    {
        $connect =$this->createQueryBuilder('e')

            ->andWhere('e.user = :user')
            ->setParameter('user', $user)

           /* ->setMaxResults()*/
            ->getQuery();
            /* ->getResult()*/

        return $connect ->execute();

}
    /**
     * @return evenements[] Returns an array of evenements objects
     */
    public function apiFindSall(): array
    {
        $qb = $this->createQueryBuilder('s')
            ->select('s.id', 's.type', 's.coutry',  's.city', 's.adress', 's.description', 's.lat', 's.lng')
            ->orderBy('s.id', 'DESC');

        $query = $qb->getQuery();

        return $query->execute();
    }
}