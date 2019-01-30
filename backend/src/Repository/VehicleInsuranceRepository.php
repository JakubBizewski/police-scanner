<?php

namespace PoliceScanner\Repository;

use PoliceScanner\Entity\Vehicle;
use PoliceScanner\Entity\VehicleInsurance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VehicleInsurance|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleInsurance|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleInsurance[]    findAll()
 * @method VehicleInsurance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleInsuranceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VehicleInsurance::class);
    }

    /**
     * @param VehicleInsurance $insurance
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(VehicleInsurance $insurance)
    {
        $this->getEntityManager()->persist($insurance);
        $this->getEntityManager()->flush($insurance);
    }

    /**
     * @param VehicleInsurance $insurance
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(VehicleInsurance $insurance)
    {
        $this->getEntityManager()->remove($insurance);
        $this->getEntityManager()->flush($insurance);
    }

    /**
     * @param Vehicle $vehicle
     * @return null|VehicleInsurance
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByVehicle(Vehicle $vehicle): ?VehicleInsurance
    {
        return $this->createQueryBuilder('insurance')
            ->where('insurance.vehicle = :vehicle')
            ->setParameter('vehicle', $vehicle)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return VehicleInsurance[] Returns an array of VehicleInsurance objects
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
    public function findOneBySomeField($value): ?VehicleInsurance
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
