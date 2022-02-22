<?php

namespace App\Controller\Admin;

use App\Entity\Comodidad;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class ComodidadCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comodidad::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nombre'),
            AssociationField::new('alojamientos')->setCrudController(AlojamientoCrudController::class)
        ];
    }

}
