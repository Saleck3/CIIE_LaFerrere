<?php

namespace App\Controller\Admin;

use App\Entity\Revista;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RevistaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Revista::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nombre'),
        ];
    }
}
