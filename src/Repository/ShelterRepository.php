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

// public function searchSheltersByCriteria($criteria): array
// {
//     $query = $this->createQueryBuilder('s')
//         ->leftJoin('s.town', 's_town')
//         ->leftJoin('s_town.department', 's_department')
//         ->leftJoin('s_department.region', 's_region')
//         ->leftJoin('s.interiorEquipment', 'ie')
//         ->leftJoin('s.exteriorEquipment', 'ee')
//         ->leftJoin('s.services', 'serv')
//         ->Where('s_town IS NULL')
//         ->orWhere('s_town = :town_id')
//         ->setParameter('town_id', $criteria['town'] ? $criteria['town']->getId() : null)
//         ->orWhere('s_department IS NULL')
//         ->orWhere('s_department = :department_id')
//         ->setParameter('department_id', $criteria['department'] ? $criteria['department']->getId() : null)
//         ->orWhere('s_region IS NULL')
//         ->orWhere('s_region = :region_id')
//         ->setParameter('region_id', $criteria['region'] ? $criteria['region']->getId() : null);

//         if (isset($criteria['interior']) && $criteria['interior']->count() > 0) {
//             $interiorIds = $criteria['interior']->map(function ($interior) {
//                 return $interior->getId();
//             })->toArray();
        
//             foreach ($interiorIds as $index => $interiorId) {
//                 $query->orWhere("ie = :interior_equipment{$index}")
//                     ->setParameter("interior_equipment{$index}", $interiorId);
//             }
//         }
//         if (isset($criteria['exterior']) && $criteria['exterior']->count() > 0) {
//             $exteriorIds = $criteria['exterior']->map(function ($exterior) {
//                 return $exterior->getId();
//             })->toArray();
        
//             foreach ($exteriorIds as $index => $exteriorId) {
//                 $query->orWhere("ee = :exterior_equipment{$index}")
//                     ->setParameter("exterior_equipment{$index}", $exteriorId);
//             }
//         }
//         if (isset($criteria['services']) && $criteria['services']->count() > 0) {
//             $serviceIds = $criteria['services']->map(function ($services) {
//                 return $services->getId();
//             })->toArray();
        
//             foreach ($serviceIds as $index => $serviceId) {
//                 $query->orWhere("serv = :services{$index}")
//                     ->setParameter("services{$index}", $serviceId);
//             }
//         }

//     return $query
//         ->getQuery()
//         ->getResult();
// }

public function searchSheltersByCriteria($criteria): array
{
    $query = $this->createQueryBuilder('s')
        ->leftJoin('s.town', 's_town')
        ->leftJoin('s_town.department', 's_department')
        ->leftJoin('s_department.region', 's_region')
        ->leftJoin('s.interiorEquipment', 'ie')
        ->leftJoin('s.exteriorEquipment', 'ee')
        ->leftJoin('s.services', 'serv');

    $andConditions = [];

    // Filtre par la ville sélectionnée 
    if (isset($criteria['town'])) {
        // Ajoute une condition pour filtrer par l'ID de la ville
        $andConditions[] = $query->expr()->eq('s_town.id', $criteria['town']->getId());
    }
    
    if (isset($criteria['department'])) {
        $andConditions[] = $query->expr()->eq('s_department.id', $criteria['department']->getId());
    }
    
    if (isset($criteria['region'])) {
        $andConditions[] = $query->expr()->eq('s_region.id', $criteria['region']->getId());
    }

    if (isset($criteria['interior']) && $criteria['interior']->count() > 0) {
        $interiorIds = $criteria['interior']->map(function ($interior) {
            return $interior->getId();
        })->toArray();
    
        $andConditions[] = $query->expr()->in('ie.id', $interiorIds);
    }
    
    if (isset($criteria['exterior']) && $criteria['exterior']->count() > 0) {
        $exteriorIds = $criteria['exterior']->map(function ($exterior) {
            return $exterior->getId();
        })->toArray();
    
        $andConditions[] = $query->expr()->in('ee.id', $exteriorIds);
    }
    
    if (isset($criteria['services']) && $criteria['services']->count() > 0) {
        $serviceIds = $criteria['services']->map(function ($service) {
            return $service->getId();
        })->toArray();
    
        $andConditions[] = $query->expr()->in('serv.id', $serviceIds);
    }
    
    //Ajoute des conditions de filtrage supplémentaires à la requête en utilisant l'opérateur logique "AND" si des conditions sont présentes.
    if (!empty($andConditions)) {
        $query->andWhere(call_user_func_array([$query->expr(), 'andX'], $andConditions));
    }

    return $query
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
