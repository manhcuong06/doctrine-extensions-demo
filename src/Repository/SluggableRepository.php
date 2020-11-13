<?php

namespace App\Repository;

use App\Entity\Sluggable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sluggable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sluggable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sluggable[]    findAll()
 * @method Sluggable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SluggableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sluggable::class);
    }

    // /**
    //  * @return Sluggable[] Returns an array of Sluggable objects
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
    public function findOneBySomeField($value): ?Sluggable
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
