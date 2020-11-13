<?php

namespace App\Repository;

use App\Entity\Sortable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sortable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortable[]    findAll()
 * @method Sortable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortable::class);
    }

    // /**
    //  * @return Sortable[] Returns an array of Sortable objects
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
    public function findOneBySomeField($value): ?Sortable
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
