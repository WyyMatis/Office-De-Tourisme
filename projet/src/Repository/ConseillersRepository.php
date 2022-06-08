<?php

namespace App\Repository;

use App\Entity\Conseillers;
use App\Entity\Langue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Conseillers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conseillers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conseillers[]    findAll()
 * @method Conseillers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConseillersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conseillers::class);
    }

    public function findAllOrderByAlpha()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Conseillers[] Returns an array of Conseillers objects
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
    public function findOneBySomeField($value): ?Conseillers
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
