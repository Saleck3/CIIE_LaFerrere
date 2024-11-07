<?php

namespace App\Controller\Admin;

use App\Entity\Cohorte;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CohorteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cohorte::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nombre'),
            DateField::new('start_date', 'Fecha de inicio'),
            DateField::new('end_date', 'Fecha de fin'),
        ];
    }
}
