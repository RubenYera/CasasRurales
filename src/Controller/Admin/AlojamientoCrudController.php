<?php

namespace App\Controller\Admin;

use App\Entity\Alojamiento;
use App\Entity\Tipo;
use App\Entity\Comodidad;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;

class AlojamientoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Alojamiento::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nombre'),
            TextareaField::new('descripcion'),
            NumberField::new('precio'),
            NumberField::new('fianza'),
            IntegerField::new('habitaciones'),
            IntegerField::new('camas'),
            ArrayField::new('fotos'),
            AssociationField::new('tipo'),
            AssociationField::new('Comodidades')->setCrudController(ComodidadCrudController::class)
        ];

    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     return $actions

    //     ;
    // }

    // public function configureCrud(Crud $crud): Crud
    // {
    //     return $crud
    //         ->setEntityPermission('ROLE_ADMIN')
    //     ;
    // }

    // public function configureResponseParameters(KeyValueStore $responseParameters): KeyValueStore
    // {
    //     if (in_array("ROLE_ADMIN",$this->getUser()->getRoles())) {
    //         $responseParameters->set('foo', '...');

    //         // keys support the "dot notation", so you can get/set nested
    //         // values separating their parts with a dot:
    //         $responseParameters->setIfNotSet('bar.foo', '...');
    //         // this is equivalent to: $parameters['bar']['foo'] = '...'
    //         var_dump($responseParameters);
    //     }
        
         

    //     return $responseParameters;
    // }
}
