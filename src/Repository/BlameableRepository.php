<?php

namespace App\Repository;

use App\Entity\Blameable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Blameable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blameable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blameable[]    findAll()
 * @method Blameable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlameableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blameable::class);
    }

    // /**
    //  * @return Blameable[] Returns an array of Blameable objects
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
    public function findOneBySomeField($value): ?Blameable
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
