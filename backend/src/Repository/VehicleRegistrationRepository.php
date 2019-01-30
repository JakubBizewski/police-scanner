<?php

namespace PoliceScanner\Repository;

use PoliceScanner\Entity\Vehicle;
use PoliceScanner\Entity\VehicleRegistration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VehicleRegistration|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleRegistration|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleRegistration[]    findAll()
 * @method VehicleRegistration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRegistrationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VehicleRegistration::class);
    }

    /**
     * @param VehicleRegistration $registration
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(VehicleRegistration $registration)
    {
        $this->getEntityManager()->persist($registration);
        $this->getEntityManager()->flush($registration);
    }

    /**
     * @param VehicleRegistration $registration
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(VehicleRegistration $registration)
    {
        $this->getEntityManager()->remove($registration);
        $this->getEntityManager()->flush($registration);
    }

    /**
     * @param string $registration
     * @return null|VehicleRegistration
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByRegistration(string $registration): ?VehicleRegistration
    {
        return $this->createQueryBuilder('reg')
            ->where('reg.number = :number')
            ->setParameter('number', $registration)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param Vehicle $vehicle
     * @return null|VehicleRegistration
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByVehicle(Vehicle $vehicle): ?VehicleRegistration
    {
        return $this->createQueryBuilder('reg')
            ->where('reg.vehicle = :vehicle')
            ->setParameter('vehicle', $vehicle)
            ->getQuery()
            ->getSingleResult();
    }

//    /**
//     * @return VehicleRegistration[] Returns an array of VehicleRegistration objects
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
    public function findOneBySomeField($value): ?VehicleRegistration
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
