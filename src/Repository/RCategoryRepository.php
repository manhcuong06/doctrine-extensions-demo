<?php

namespace App\Repository;

use App\Entity\RCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method RCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method RCategory[]    findAll()
 * @method RCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RCategory::class);
    }

    // /**
    //  * @return RCategory[] Returns an array of RCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RCategory
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
