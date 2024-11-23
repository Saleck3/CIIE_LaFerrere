<?php

namespace App\Controller\Admin;

use App\Entity\Encuentro;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class EncuentroCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Encuentro::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('date')
        ];
    }

}
