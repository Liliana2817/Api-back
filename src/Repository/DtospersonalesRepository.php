<?php

namespace App\Repository;

use App\Entity\Dtospersonales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dtospersonales>
 *
 * @method Dtospersonales|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dtospersonales|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dtospersonales[]    findAll()
 * @method Dtospersonales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DtospersonalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dtospersonales::class);
    }

//    /**
//     * @return Dtospersonales[] Returns an array of Dtospersonales objects
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

//    public function findOneBySomeField($value): ?Dtospersonales
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
