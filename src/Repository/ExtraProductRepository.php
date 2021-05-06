<?php

namespace App\Repository;

use App\Entity\ExtraProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExtraProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExtraProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExtraProduct[]    findAll()
 * @method ExtraProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExtraProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExtraProduct::class);
    }

    // /**
    //  * @return ExtraProduct[] Returns an array of ExtraProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExtraProduct
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
