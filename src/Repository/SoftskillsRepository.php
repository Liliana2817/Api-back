<?php

namespace App\Repository;

use App\Entity\Softskills;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Softskills>
 *
 * @method Softskills|null find($id, $lockMode = null, $lockVersion = null)
 * @method Softskills|null findOneBy(array $criteria, array $orderBy = null)
 * @method Softskills[]    findAll()
 * @method Softskills[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoftskillsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Softskills::class);
    }

//    /**
//     * @return Softskills[] Returns an array of Softskills objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Softskills
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
