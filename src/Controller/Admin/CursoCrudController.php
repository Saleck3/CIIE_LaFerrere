<?php

namespace App\Controller\Admin;

use App\Entity\Curso;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CursoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Curso::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nombre'),
            TextField::new('clave', 'Clave'),
        ];
    }
}
