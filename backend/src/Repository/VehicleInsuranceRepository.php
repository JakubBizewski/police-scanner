<?php

namespace PoliceScanner\Repository;

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
