<?php

namespace App\Repository;

use App\Entity\YatzyHighScore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method YatzyHighScore|null find($id, $lockMode = null, $lockVersion = null)
 * @method YatzyHighScore|null findOneBy(array $criteria, array $orderBy = null)
 * @method YatzyHighScore[]    findAll()
 * @method YatzyHighScore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YatzyHighScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, YatzyHighScore::class);
    }

    /**
     * Find all ordered by score
     * @return YatzyHighScore[] returns an
     * array with YatzyHighScores
     * 
     */
    public function findAllOrderedByScore(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT y
            FROM App\Entity\YatzyHighScore y
            ORDER BY y.score DESC'
        );

        return $query->getResult();
    }

    /**
     * Find all scores in DESC order
     * @return array returns an
     * array with scores
     * 
     */
    public function findAllScores(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT y.score
            FROM App\Entity\YatzyHighScore y
            ORDER BY y.score DESC'
        );

        return $query->getResult();
    }

    // /**
    //  * @return YatzyHighScore[] Returns an array of YatzyHighScore objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?YatzyHighScore
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
