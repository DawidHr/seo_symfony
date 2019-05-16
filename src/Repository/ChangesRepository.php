<?php

namespace App\Repository;

use App\Entity\Changes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Changes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Changes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Changes[]    findAll()
 * @method Changes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChangesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Changes::class);
    }

    // /**
    //  * @return Changes[] Returns an array of Changes objects
    //  */
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
    public function findOneBySomeField($value): ?Changes
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
