<?php

namespace PoliceScanner\Repository;

use PoliceScanner\Entity\VehicleModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VehicleModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleModel[]    findAll()
 * @method VehicleModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleModelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VehicleModel::class);
    }

    /**
     * @param VehicleModel $vehicleModel
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(VehicleModel $vehicleModel)
    {
        $this->getEntityManager()->persist($vehicleModel);
        $this->getEntityManager()->flush($vehicleModel);
    }

    /**
     * @param VehicleModel $vehicleModel
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(VehicleModel $vehicleModel)
    {
        $this->getEntityManager()->remove($vehicleModel);
        $this->getEntityManager()->flush($vehicleModel);
    }

//    /**
//     * @return VehicleModel[] Returns an array of VehicleModel objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VehicleModel
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
