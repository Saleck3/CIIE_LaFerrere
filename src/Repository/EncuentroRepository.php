<?php

namespace App\Repository;

use App\Entity\Encuentro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Encuentro>
 * @method Encuentro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Encuentro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Encuentro[]    findAll()
 * @method Encuentro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncuentroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Encuentro::class);
    }

    public function add(Encuentro $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //Alias
    public function save(Encuentro $entity, bool $flush = false): void
    {
        $this->add($entity, $flush);
    }

    public function remove(Encuentro $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
