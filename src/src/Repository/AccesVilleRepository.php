<?php

namespace App\Repository;

use App\Entity\AccesVille;
use App\Entity\Ville;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\DriverManager;

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
    //!b.population, b.score_global, b.acces_numerique, b.nom_iris,
    //!b.acces_information, b.competences_administrative, b.competence_numerique_scolaire, b.global_acces, b.global_competence

    public function findAvgAccesNumeriqueDepartementByDepartementName($dep)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.acces_numerique)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.departement = :dep';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('dep' => $dep));
        return $stmt->fetchOne();
    }

    public function findAvgAccesNumeriqueRegionByRegionName($reg): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.acces_numerique)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.region = :reg';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('reg' => $reg));
        return $stmt->fetchOne();
    }

    public function findAvgAccesInformationDepartementByDepartementName($dep): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.acces_information)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.departement = :dep';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('dep' => $dep));
        return $stmt->fetchOne();
    }

    public function findAvgAccesInformationRegionByRegionName($reg): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.acces_information)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.region = :reg';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('reg' => $reg));
        return $stmt->fetchOne();
    }

    public function findAvgCompetencesAdministrativeDepartementByDepartementName($dep): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.competences_administrative)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.departement = :dep';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('dep' => $dep));
        return $stmt->fetchOne();
    }

    public function findAvgCompetencesAdministrativeRegionByRegionName($reg): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.competences_administrative)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.region = :reg';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('reg' => $reg));
        return $stmt->fetchOne();
    }

    public function findAvgCompeteneNumeriqueDepartementByDepartementName($dep): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.competence_numerique_scolaire)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.departement = :dep';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('dep' => $dep));
        return $stmt->fetchOne();
    }

    public function findAvgCompetenceNumeriqueRegionByRegionName($reg): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.competence_numerique_scolaire)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.region = :reg';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('reg' => $reg));
        return $stmt->fetchOne();
    }


}
