<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AddressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Address::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('add_nb_street'),
            TextField::new('add_address_line_1'),
            TextField::new('add_address_line_1'),
            TextField::new('add_city'),
            TextField::new('add_state'),
            IntegerField::new('add_zip'),
            CountryField::new('country'),
        ];
    }

}
