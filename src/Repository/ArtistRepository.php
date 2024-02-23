<?php

namespace App\Repository;

use App\Entity\Crew;
use App\Entity\Artist;
use App\Entity\Gender;
use App\Entity\ActType;
use App\Entity\ArtistType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\Collection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Artist>
 *
 * @method Artist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artist[]    findAll()
 * @method Artist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artist::class);
    }

    /**
     * @return Artist[] Returns an array of Artist objects
     */
    public function searchArtists(?string $name, ?bool $verified, ?Collection $artistTypes, ?Collection $actTypes, ?Collection $genders, ?Collection $crews, ?int $limit = 10): ?array
    {
        $query = $this->createQueryBuilder('a');

        if ($name !== null) {
            $query->andWhere('a.Name = :name')
                ->setParameter('name', $name);
        }
    
        if ($verified !== null && $verified === true) {
            $query->andWhere('a.isVerified = :verified')
                ->setParameter('verified', $verified);
        }
    
        if ($artistTypes !== null && !$artistTypes->isEmpty()) {
            $artistTypeIds = [];
            foreach ($artistTypes as $artistType) {
                $artistTypeIds[] = $artistType->getId();
            }
            $query->andWhere('a.ArtistType IN (:artistTypeIds)')
                ->setParameter('artistTypeIds', $artistTypeIds);
        }
    
        if ($actTypes !== null && !$actTypes->isEmpty()) {
            $actTypeIds = [];
            foreach ($actTypes as $actType) {
                $actTypeIds[] = $actType->getId();
            }
            $query->andWhere('a.ActType IN (:actTypeIds)')
                ->setParameter('actTypeIds', $actTypeIds);
        }
    
        if ($genders !== null && !$genders->isEmpty()) {
            $genderIds = [];
            foreach ($genders as $gender) {
                $genderIds[] = $gender->getId();
            }
            $query->andWhere('a.Gender IN (:genderIds)')
                ->setParameter('genderIds', $genderIds);
        }
    
        if ($crews !== null && !$crews->isEmpty()) {
            $crewIds = [];
            foreach ($crews as $crew) {
                $crewIds[] = $crew->getId();
            }
            $query->andWhere('a.Crews IN (:crewIds)')
                ->setParameter('crewIds', $crewIds);
        }

        return $query
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Artist[] Returns an array of Artist objects
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

//    public function findOneBySomeField($value): ?Artist
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
