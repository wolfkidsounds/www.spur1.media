<?php

namespace App\Repository;

use App\Entity\OrbiterSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrbiterSession>
 *
 * @method OrbiterSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrbiterSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrbiterSession[]    findAll()
 * @method OrbiterSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrbiterSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrbiterSession::class);
    }

//    /**
//     * @return OrbiterSession[] Returns an array of OrbiterSession objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrbiterSession
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
