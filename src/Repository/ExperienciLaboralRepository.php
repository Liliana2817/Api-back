<?php

namespace App\Repository;

use App\Entity\ExperienciLaboral;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExperienciLaboral>
 *
 * @method ExperienciLaboral|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExperienciLaboral|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExperienciLaboral[]    findAll()
 * @method ExperienciLaboral[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExperienciLaboralRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExperienciLaboral::class);
    }

//    /**
//     * @return ExperienciLaboral[] Returns an array of ExperienciLaboral objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExperienciLaboral
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
