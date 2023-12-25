<?php

namespace App\Repository;

use App\Entity\BloodSampling;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
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


    public function getEm(): EntityManagerInterface
    {
        return $this->_em;
    }
}
