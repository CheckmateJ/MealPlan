<?php

namespace App\Repository;

use App\Entity\MealPlanItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MealPlanItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method MealPlanItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method MealPlanItem[]    findAll()
 * @method MealPlanItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MealPlanItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MealPlanItem::class);
    }

    // /**
    //  * @return MealPlanItem[] Returns an array of MealPlanItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MealPlanItem
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
