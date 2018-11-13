<?php

namespace PoliceScanner\Repository;

use PoliceScanner\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use PoliceScanner\Model\VehicleSaveModel;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicle[]    findAll()
 * @method Vehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

    /**
     * @param Vehicle $vehicle
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Vehicle $vehicle)
    {
        $this->getEntityManager()->persist($vehicle);
        $this->getEntityManager()->flush($vehicle);
    }

    /**
     * @param Vehicle $vehicle
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Vehicle $vehicle)
    {
        $this->getEntityManager()->remove($vehicle);
        $this->getEntityManager()->flush($vehicle);
    }

    /**
     * @param string $vin
     * @return null|Vehicle
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByVin(string $vin): ?Vehicle
    {
        return $this->createQueryBuilder('veh')
            ->where('veh.vin = :vin')
            ->setParameter('vin', $vin)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return Vehicle[] Returns an array of Vehicle objects
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
    public function findOneBySomeField($value): ?Vehicle
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
