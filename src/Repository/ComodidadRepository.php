<?php

namespace App\Repository;

use App\Entity\Comodidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comodidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comodidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comodidad[]    findAll()
 * @method Comodidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComodidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comodidad::class);
    }

    // /**
    //  * @return Comodidad[] Returns an array of Comodidad objects
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
    public function findOneBySomeField($value): ?Comodidad
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
