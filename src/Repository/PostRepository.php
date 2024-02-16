<?php //src/Repository/PostRepository.php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * Search term
     *
     * @return Post[]
     */
    public function search(?string $term)
    {
        $qb = $this->createQueryBuilder('post');

        if ($term) {
            $qb->andWhere('post.Title LIKE :term')
                ->setParameter('term', '%'.$term.'%');
        }

        return $qb
            ->getQuery()
            ->execute();
    }
}
