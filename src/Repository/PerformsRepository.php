<?php

namespace App\Repository;

use App\Entity\Performs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Performs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Performs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Performs[]    findAll()
 * @method Performs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Performs::class);
    }

    // /**
    //  * @return Performs[] Returns an array of Performs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Performs
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
