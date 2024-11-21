<?php

namespace App\Controller\Admin;

use App\Entity\Encuentro;
use App\Entity\Resolucion;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ResolucionCrudController extends AbstractCrudController
{
    public function __construct()
    {
    }

    public static function getEntityFqcn(): string
    {
        return Resolucion::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Clave'),
            AssociationField::new('curso'),
            AssociationField::new('cohorte'),
            AssociationField::new('docente')->setQueryBuilder(
                fn(QueryBuilder $queryBuilder) => $queryBuilder->where("entity.roles LIKE '%%ROLE_TEACHER%%'")
            )->setSortProperty('username'),
            CollectionField::new('encuentros')->useEntryCrudForm(),
            AssociationField::new('cursantes')->setSortProperty('username'),
        ];
    }

    public function addEncuentro(Encuentro $encuentro): void
    {
        $encuentro->setResolucion($this);

        if (!$this->encuentros->contains($encuentro)) {
            $this->encuentros->add($encuentro);
        }
    }

    public function removeEncuentro(Encuentro $encuentro): void
    {
        $this->encuentros->removeElement($encuentro);
    }

}
