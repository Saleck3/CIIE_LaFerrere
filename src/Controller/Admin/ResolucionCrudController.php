<?php

namespace App\Controller\Admin;

use App\Entity\Curso;
use App\Entity\Resolucion;
use App\Repository\CursoRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ResolucionCrudController extends AbstractCrudController
{
    public function __construct(private readonly CursoRepository $cursoRepository)
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
            TextField::new('name', 'Nombre'),
            //TODO Agregar campos select para Curso, Cohorte, Profesor y revista
        ];
    }

}
