<?php

namespace App\Repository;

use App\Entity\Loggable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Loggable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Loggable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Loggable[]    findAll()
 * @method Loggable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoggableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Loggable::class);
    }

    // /**
    //  * @return Loggable[] Returns an array of Loggable objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Loggable
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
