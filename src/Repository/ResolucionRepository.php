<?php

namespace App\Repository;

use App\Entity\Resolucion;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\Collection;

/**
 * @extends ServiceEntityRepository<Resolucion>
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

    public function findAllByUser(
        User $docente
    ): array
    {
        return $this->findAllQuery(
            withCohorte: true,
            withCurso: true,
        )->where('r.docente IN (:docente)')
            ->setParameter(
                'docente',
                $docente
            )->getQuery()
            ->getResult();
    }

    private function findAllQuery(
        bool $withDocentes = false,
        bool $withCohorte = false,
        bool $withCurso = false,
    ): QueryBuilder
    {
        $query = $this->createQueryBuilder('r');

        if ($withDocentes) {
            $query->leftJoin('r.docente', 'd')
                ->addSelect('d');
        }

        if ($withCohorte) {
            $query->leftJoin('r.cohorte', 'co')
                ->addSelect('co');
        }

        if ($withCurso) {
            $query->leftJoin('r.curso', 'c')
                ->addSelect('c');
        }

        return $query;
    }
}
