<?php

namespace App\Repository;

use App\Entity\RecSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecSession>
 *
 * @method RecSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecSession[]    findAll()
 * @method RecSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecSession::class);
    }

    //    /**
    //     * @return RecSession[] Returns an array of RecSession objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RecSession
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
