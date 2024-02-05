<?php

namespace App\Repository;

use App\Entity\Laveur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Laveur>
 *
 * @method Laveur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Laveur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Laveur[]    findAll()
 * @method Laveur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LaveurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Laveur::class);
    }

//    /**
//     * @return Laveur[] Returns an array of Laveur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Laveur
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
