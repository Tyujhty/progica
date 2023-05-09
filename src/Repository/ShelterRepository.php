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
       return $this->createQueryBuilder('s')      
           ->Where('s.town = :town_id')
           ->setParameter('town_id', $criteria['town']->getId())
           ->setMaxResults(30)
           ->getQuery()
           ->getResult()
       ;
   }
   #
//    public function findSearch(SearchType $search)
//    {
//         $query = $this
//             ->createQueryBuilder('s')
//             ->select('s', 't')
//             ->join('s.town', 's');

//             if(!empty($search->q)) {
//                 $query = $query
//                     ->andWhere('s.town LIKE :q')
//                     ->setParameter('q', "%{$search->q}%");
//             }

             

//         return $query->getQuery()->getResult();
//    }

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
