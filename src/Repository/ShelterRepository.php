<?php

namespace App\Repository;

use App\Entity\Shelter;
use App\Form\SearchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Shelter>
 *
 * @method Shelter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shelter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shelter[]    findAll()
 * @method Shelter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShelterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shelter::class);
    }

    public function save(Shelter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Shelter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    

//    /**
//     * @return Shelter[] Returns an array of Shelter objects
//     */

public function searchShelterFromTown($criteria): array
{
    $query = $this->createQueryBuilder('s')
        ->leftJoin('s.town', 's_town') // Jointure avec la table "town"
        ->leftJoin('s_town.department', 's_department') // Jointure avec la table "department" via la table "town"
        ->leftJoin('s_department.region', 's_region') // Jointure avec la table "region" via la table "department"
        ->where('s_town IS NULL')
        ->orWhere('s_town = :town_id')
        ->setParameter('town_id', $criteria['town'] ? $criteria['town']->getId() : null)
        ->orWhere('s_department IS NULL')
        ->orWhere('s_department = :department_id')
        ->setParameter('department_id', $criteria['department'] ? $criteria['department']->getId() : null)
        ->orWhere('s_region IS NULL')
        ->orWhere('s_region = :region_id')
        ->setParameter('region_id', $criteria['region'] ? $criteria['region']->getId() : null);

    return $query
        ->setMaxResults(30)
        ->getQuery()
        ->getResult();
}


//    public function findOneBySomeField($value): ?Shelter
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
