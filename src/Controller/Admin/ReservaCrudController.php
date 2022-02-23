<?php

namespace App\Controller\Admin;

use App\Entity\Reserva;
use App\Entity\User;
use App\Entity\Alojamiento;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReservaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reserva::class;
    }


    public function configureFields(string $pageName): iterable
    {
        // return [
        //     IdField::new('id'),
        //     TextField::new('title'),
        //     TextEditorField::new('description'),
        // ];

        return [
            DateField::new('fecha_ini'),
            DateField::new('fecha_fin'),
            DateTimeField::new('fecha_reserva'),
            AssociationField::new('alojamiento'),
            AssociationField::new('User'),
        ];
    }
}