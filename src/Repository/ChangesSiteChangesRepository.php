<?php

namespace App\Repository;

use App\Entity\ChangesSiteChanges;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ChangesSiteChanges|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChangesSiteChanges|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChangesSiteChanges[]    findAll()
 * @method ChangesSiteChanges[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChangesSiteChangesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ChangesSiteChanges::class);
    }

    // /**
    //  * @return ChangesSiteChanges[] Returns an array of ChangesSiteChanges objects
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
    public function findOneBySomeField($value): ?ChangesSiteChanges
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
