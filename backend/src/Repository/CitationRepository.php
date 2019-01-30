<?php

namespace PoliceScanner\Repository;

use PoliceScanner\Entity\Citation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use PoliceScanner\Entity\Citizen;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Citation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Citation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Citation[]    findAll()
 * @method Citation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CitationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Citation::class);
    }

    /**
     * @param Citation $citation
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Citation $citation)
    {
        $this->getEntityManager()->persist($citation);
        $this->getEntityManager()->flush($citation);
    }

    /**
     * @param Citation $citation
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Citation $citation)
    {
        $this->getEntityManager()->remove($citation);
        $this->getEntityManager()->flush($citation);
    }

    /**
     * @param Citizen $citizen
     * @return Citation[]
     */
    public function findByCitizen(Citizen $citizen)
    {
        return $this->createQueryBuilder('citation')
            ->where('citation.citizen = :citizen')
            ->setParameter('citizen', $citizen)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Citation[] Returns an array of Citation objects
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
    public function findOneBySomeField($value): ?Citation
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
