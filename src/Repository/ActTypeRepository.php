<?php

namespace App\Repository;

use App\Entity\ActType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ActType>
 *
 * @method ActType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActType[]    findAll()
 * @method ActType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActType::class);
    }

//    /**
//     * @return ActType[] Returns an array of ActType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ActType
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
