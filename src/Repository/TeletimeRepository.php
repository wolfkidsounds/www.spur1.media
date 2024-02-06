<?php

namespace App\Repository;

use App\Entity\Teletime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Teletime>
 *
 * @method Teletime|null find($id, $lockMode = null, $lockVersion = null)
 * @method Teletime|null findOneBy(array $criteria, array $orderBy = null)
 * @method Teletime[]    findAll()
 * @method Teletime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeletimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teletime::class);
    }

//    /**
//     * @return Teletime[] Returns an array of Teletime objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Teletime
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
