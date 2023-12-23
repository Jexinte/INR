<?php

namespace App\Repository;

use App\Entity\BloodSampling;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BloodSampling>
 *
 * @method BloodSampling|null find($id, $lockMode = null, $lockVersion = null)
 * @method BloodSampling|null findOneBy(array $criteria, array $orderBy = null)
 * @method BloodSampling[]    findAll()
 * @method BloodSampling[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodSamplingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BloodSampling::class);
    }

//    /**
//     * @return BloodSampling[] Returns an array of BloodSampling objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BloodSampling
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
