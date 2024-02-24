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
        $query = $this->createQueryBuilder('artist');

        if ($name !== null) {
            $query->andWhere('artist.Name = :name')
                ->setParameter('name', $name);
        }
    
        if ($verified !== null && $verified === true) {
            $query->andWhere('artist.isVerified = :verified')
                ->setParameter('verified', $verified);
        }
    
        if ($artistTypes !== null && !$artistTypes->isEmpty()) {
            $query->join('artist.ArtistType', 'artist_type');
            $artistTypeIds = [];

            foreach ($artistTypes as $artistType) {
                $artistTypeIds[] = $artistType->getId();
            }

            $query->andWhere('artist_type.id IN (:artistTypeIds)')
                ->setParameter('artistTypeIds', $artistTypeIds);
        }

        if ($actTypes !== null && !$actTypes->isEmpty()) {
            $query->join('artist.ActType', 'act_type');
            $actTypeIds = [];
        
            foreach ($actTypes as $actType) {
                $actTypeIds[] = $actType->getId();
            }
        
            $query->andWhere('act_type.id IN (:actTypeIds)')
                ->setParameter('actTypeIds', $actTypeIds);
        }
    
        if ($genders !== null && !$genders->isEmpty()) {
            $query->join('artist.Gender', 'gender');
            $genderIds = [];

            foreach ($genders as $gender) {
                $genderIds[] = $gender->getId();
            }

            $query->andWhere('gender.id IN (:genderIds)')
                ->setParameter('genderIds', $genderIds);
        }
    
        if ($crews !== null && !$crews->isEmpty()) {
            $query->join('artist.Crews', 'crew');
            $crewIds = [];

            foreach ($crews as $crew) {
                $crewIds[] = $crew->getId();
            }

            $query->andWhere('crew.id IN (:crewIds)')
                ->setParameter('crewIds', $crewIds);
        }

        return $query
            ->orderBy('artist.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
