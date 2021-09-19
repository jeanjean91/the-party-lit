<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
      * @return User[] Returns an array of User objects
      */

    /*public function findByuserevent($user)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.user = :user')
            ->setParameter('user', $user)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
        ;
    }*/
    public function findByExampleField ()
    {
        $entityManager = $this ->getEntityManager();

        $connect= $entityManager ->createQuery(    " 
            SELECT  distinct COUNT( e.id) as total
             FROM App\Entity\User e
             WHERE e.id = e.id
             ") ;




        return $connect ->execute();
    }

   /* public function findByExampleField()
    {
        $qb = $this->createQueryBuilder('t');
        return $qb
            ->select('count(t.id)as total')
            ->from('App\Entity\User','user')
            ->getQuery()
            ->getSingleScalarResult();

        return  $qb ->execute();

    }*/
   /* public function count($user)
    {
        $qb = $this->createQueryBuilder('t');
        return $qb
            ->select('count(t.id)')
            ->from(UserRepository::class)
            ->useQueryCache(true)
            ->getQuery()
            ->getSingleScalarResult();
        return $qb->execute();
    }*/

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
