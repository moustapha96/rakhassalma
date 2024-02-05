<?php

namespace App\Repository;

use App\Entity\TypeLavage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeLavage>
 *
 * @method TypeLavage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeLavage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeLavage[]    findAll()
 * @method TypeLavage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeLavageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeLavage::class);
    }

//    /**
//     * @return TypeLavage[] Returns an array of TypeLavage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeLavage
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
