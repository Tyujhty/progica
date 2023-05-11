<?php

namespace App\Repository;

use App\Entity\ExteriorEquipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExteriorEquipment>
 *
 * @method ExteriorEquipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExteriorEquipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExteriorEquipment[]    findAll()
 * @method ExteriorEquipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExteriorEquipmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExteriorEquipment::class);
    }

    public function save(ExteriorEquipment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ExteriorEquipment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ExteriorEquipment[] Returns an array of ExteriorEquipment objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExteriorEquipment
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
