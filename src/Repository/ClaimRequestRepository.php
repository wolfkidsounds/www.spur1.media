<?php

namespace App\Repository;

use App\Entity\ClaimRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClaimRequest>
 *
 * @method ClaimRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClaimRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClaimRequest[]    findAll()
 * @method ClaimRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClaimRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClaimRequest::class);
    }

    //    /**
    //     * @return ClaimRequest[] Returns an array of ClaimRequest objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ClaimRequest
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
