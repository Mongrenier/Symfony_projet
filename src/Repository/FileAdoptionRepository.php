<?php

namespace App\Repository;

use App\Entity\FileAdoption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FileAdoption|null find($id, $lockMode = null, $lockVersion = null)
 * @method FileAdoption|null findOneBy(array $criteria, array $orderBy = null)
 * @method FileAdoption[]    findAll()
 * @method FileAdoption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileAdoptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileAdoption::class);
    }

    // /**
    //  * @return FileAdoption[] Returns an array of FileAdoption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FileAdoption
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
