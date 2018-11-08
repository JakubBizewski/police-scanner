<?php

namespace PoliceScanner\Repository;

use PoliceScanner\Entity\Citizen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use PoliceScanner\Model\VehicleBrandModel;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Citizen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Citizen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Citizen[]    findAll()
 * @method Citizen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CitizenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Citizen::class);
    }

    /**
     * @param Citizen $citizen
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Citizen $citizen)
    {
        $this->getEntityManager()->persist($citizen);
        $this->getEntityManager()->flush($citizen);
    }

    /**
     * @param Citizen $citizen
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Citizen $citizen)
    {
        $this->getEntityManager()->remove($citizen);
        $this->getEntityManager()->flush($citizen);
    }

//    /**
//     * @return Citizen[] Returns an array of Citizen objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Citizen
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
