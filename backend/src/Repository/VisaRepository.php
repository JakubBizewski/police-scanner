<?php

namespace PoliceScanner\Repository;

use PoliceScanner\Entity\Citizen;
use PoliceScanner\Entity\Visa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Visa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visa[]    findAll()
 * @method Visa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Visa::class);
    }

    /**
     * @param Visa $visa
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Visa $visa)
    {
        $this->getEntityManager()->persist($visa);
        $this->getEntityManager()->flush($visa);
    }

    /**
     * @param Visa $visa
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Visa $visa)
    {
        $this->getEntityManager()->remove($visa);
        $this->getEntityManager()->flush($visa);
    }

    /**
     * @param Citizen $citizen
     * @return null|Visa
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByCitizen(Citizen $citizen): ?Visa
    {
        return $this->createQueryBuilder('visa')
            ->where('visa.owner = :citizen')
            ->setParameter('citizen', $citizen)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return Visa[] Returns an array of Visa objects
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
    public function findOneBySomeField($value): ?Visa
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
