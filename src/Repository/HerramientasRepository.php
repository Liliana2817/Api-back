<?php

namespace App\Repository;

use App\Entity\Herramientas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Herramientas>
 *
 * @method Herramientas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Herramientas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Herramientas[]    findAll()
 * @method Herramientas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HerramientasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Herramientas::class);
    }

//    /**
//     * @return Herramientas[] Returns an array of Herramientas objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Herramientas
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
