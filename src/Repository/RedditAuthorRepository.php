<?php

namespace App\Repository;

use App\Entity\RedditAuthor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RedditAuthor|null find($id, $lockMode = null, $lockVersion = null)
 * @method RedditAuthor|null findOneBy(array $criteria, array $orderBy = null)
 * @method RedditAuthor[]    findAll()
 * @method RedditAuthor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RedditAuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RedditAuthor::class);
    }

    // /**
    //  * @return RedditAuthor[] Returns an array of RedditAuthor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RedditAuthor
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
