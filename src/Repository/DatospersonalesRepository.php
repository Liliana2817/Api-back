<?php

namespace App\Repository;

use App\Entity\Datospersonales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Datospersonales>
 *
 * @method Datospersonales|null find($id, $lockMode = null, $lockVersion = null)
 * @method Datospersonales|null findOneBy(array $criteria, array $orderBy = null)
 * @method Datospersonales[]    findAll()
 * @method Datospersonales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatospersonalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Datospersonales::class);
    }

//    /**
//     * @return Datospersonales[] Returns an array of Datospersonales objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Datospersonales
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
