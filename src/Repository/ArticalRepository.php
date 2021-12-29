<?php

namespace App\Repository;

use App\Entity\Artical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Artical|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artical|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artical[]    findAll()
 * @method Artical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artical::class);
    }

    // /**
    //  * @return Artical[] Returns an array of Artical objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Artical
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
