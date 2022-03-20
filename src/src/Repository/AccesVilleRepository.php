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

    public function findSearch($data, $page = 0, $max = NULL, $getResult = true)
    {
        $qb = $this->_em->createQueryBuilder();
        $query = isset($data['query']) && $data['query']?$data['query']:null;

        $qb
            ->select('u')
            ->from(AccesVille::class, 'u')
        ;

        if ($query) {
            $qb
                ->andWhere('u.name like :query')
                ->setParameter('query', "%".$query."%")
            ;
        }

        if ($max) {
            $preparedQuery = $qb->getQuery()
                ->setMaxResults($max)
                ->setFirstResult($page * $max)
            ;
        } else {
            $preparedQuery = $qb->getQuery();
        }

        return $getResult?$preparedQuery->getResult():$preparedQuery;
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

    // donne le nom du departement et de la region + les indices d'une ville
    public function findVilleIndicesDepartementRegion($ville)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT  b.score_global, b.acces_numerique, b.acces_information, b.competences_administrative, b.competence_numerique_scolaire, b.global_acces, b.global_competence, a.departement, a.region FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE b.nom = :ville';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('ville' => $ville));
        return $stmt->fetchAssociative();
    }
    //? toutes les queries pour avoir la moyenne des indice selon le nom du departement ou de la region

    // --------- interface numerique
    // departement
    public function findAvgAccesNumeriqueDepartementByDepartementName($dep)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.acces_numerique)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.departement = :dep';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('dep' => $dep));
        return $stmt->fetchOne();
    }

    public function findAvgAccesNumeriqueRegionByRegionName($reg)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.acces_numerique)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.region = :reg';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('reg' => $reg));
        return $stmt->fetchOne();
    }

    // ------- acces à l'information
    // departement
    public function findAvgAccesInformationDepartementByDepartementName($dep)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.acces_information)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.departement = :dep';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('dep' => $dep));
        return $stmt->fetchOne();
    }

    public function findAvgAccesInformationRegionByRegionName($reg)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.acces_information)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.region = :reg';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('reg' => $reg));
        return $stmt->fetchOne();
    }

    //-------- competence administrative
    // departement
    public function findAvgCompetencesAdministrativeDepartementByDepartementName($dep)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.competences_administrative)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.departement = :dep';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('dep' => $dep));
        return $stmt->fetchOne();
    }

    public function findAvgCompetencesAdministrativeRegionByRegionName($reg)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.competences_administrative)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.region = :reg';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('reg' => $reg));
        return $stmt->fetchOne();
    }

    //---------- competence numérique
    // departement
    public function findAvgCompeteneNumeriqueDepartementByDepartementName($dep)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.competence_numerique_scolaire)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.departement = :dep';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('dep' => $dep));
        return $stmt->fetchOne();
    }

    // region
    public function findAvgCompetenceNumeriqueRegionByRegionName($reg)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.competence_numerique_scolaire)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.region = :reg';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('reg' => $reg));
        return $stmt->fetchOne();
    }

    //---------- score global
    // departement
    public function findAvgScoreGlobalDepartementByDepartementName($dep)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.score_global)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.departement = :dep';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('dep' => $dep));
        return $stmt->fetchOne();
    }

    // region
    public function findAvgScoreGlobalRegionByRegionName($reg)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT avg(b.score_global)FROM public.acces_ville b RIGHT JOIN public.ville a ON b.nom = a.name WHERE a.region = :reg';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('reg' => $reg));
        return $stmt->fetchOne();
    }

}

