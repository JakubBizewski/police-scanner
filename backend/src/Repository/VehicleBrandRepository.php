<?php

namespace PoliceScanner\Repository;

use PoliceScanner\Entity\VehicleBrand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VehicleBrand|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleBrand|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleBrand[]    findAll()
 * @method VehicleBrand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleBrandRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VehicleBrand::class);
    }

    /**
     * @param VehicleBrand $brand
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(VehicleBrand $brand)
    {
        $this->getEntityManager()->persist($brand);
        $this->getEntityManager()->flush($brand);
    }

    /**
     * @param VehicleBrand $brand
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(VehicleBrand $brand)
    {
        $this->getEntityManager()->remove($brand);
        $this->getEntityManager()->flush($brand);
    }

//    /**
//     * @return VehicleBrand[] Returns an array of VehicleBrand objects
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
    public function findOneBySomeField($value): ?VehicleBrand
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
