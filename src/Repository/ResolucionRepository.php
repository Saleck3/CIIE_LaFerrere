<?php

namespace App\Repository;

use App\Entity\Resolucion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Resolucion>
 *
 * @method Resolucion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resolucion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resolucion[]    findAll()
 * @method Resolucion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResolucionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resolucion::class);
    }

//    /**
//     * @return Resolucion[] Returns an array of Resolucion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Resolucion
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
