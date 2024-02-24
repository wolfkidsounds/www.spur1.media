<?php

namespace App\Repository;

use App\Entity\NebenDerSpur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NebenDerSpur>
 *
 * @method NebenDerSpur|null find($id, $lockMode = null, $lockVersion = null)
 * @method NebenDerSpur|null findOneBy(array $criteria, array $orderBy = null)
 * @method NebenDerSpur[]    findAll()
 * @method NebenDerSpur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NebenDerSpurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NebenDerSpur::class);
    }

    //    /**
    //     * @return NebenDerSpur[] Returns an array of NebenDerSpur objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?NebenDerSpur
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
