<?php

namespace App\Repository;

use App\Entity\AccesVille;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AccesVille|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccesVille|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccesVille[]    findAll()
 * @method AccesVille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccesVilleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccesVille::class);
    }

    // /**
    //  * @return AccesVille[] Returns an array of AccesVille objects
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
    public function findOneBySomeField($value): ?AccesVille
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
