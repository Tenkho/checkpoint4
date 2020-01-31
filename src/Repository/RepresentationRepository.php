<?php

namespace App\Repository;

use App\Entity\Representation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Representation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Representation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Representation[]    findAll()
 * @method Representation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepresentationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Representation::class);
    }

    public function findTheNext()
    {
        $now = new \DateTime('now');
        $qb = $this->createQueryBuilder('r')
            ->where('r.date > :now')
            ->setParameter('now', new \Datetime(date('Ymd')))
            ->orderBy('r.date', 'ASC')
            ->setMaxResults(1)
            ;

        $query = $qb->getQuery();

        return $query->execute();
    }
}
