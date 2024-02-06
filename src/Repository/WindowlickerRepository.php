<?php

namespace App\Repository;

use App\Entity\Windowlicker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Windowlicker>
 *
 * @method Windowlicker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Windowlicker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Windowlicker[]    findAll()
 * @method Windowlicker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WindowlickerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Windowlicker::class);
    }

//    /**
//     * @return Windowlicker[] Returns an array of Windowlicker objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Windowlicker
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
