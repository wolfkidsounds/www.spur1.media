<?php

namespace App\Repository;

use App\Entity\TagFormat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TagFormat>
 *
 * @method TagFormat|null find($id, $lockMode = null, $lockVersion = null)
 * @method TagFormat|null findOneBy(array $criteria, array $orderBy = null)
 * @method TagFormat[]    findAll()
 * @method TagFormat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagFormatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TagFormat::class);
    }

//    /**
//     * @return TagFormat[] Returns an array of TagFormat objects
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

//    public function findOneBySomeField($value): ?TagFormat
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
