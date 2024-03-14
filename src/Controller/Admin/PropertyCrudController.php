<?php

namespace App\Controller\Admin;

use App\Entity\Property;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural("Propriétés")
            ->setEntityLabelInSingular("une propriété")
            //->setDateFormat('...')
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('prop_nb_beds'),
            IntegerField::new('prop_nb_baths'),
            IntegerField::new('prop_nb_spaces'),
            IntegerField::new('prop_nb_rooms'),
            IntegerField::new('prop_sqm'),
            BooleanField::new('prop_furnished'),
            ChoiceField::new('prop_housing_type')->setChoices([
                "Maison" => "Houses",
                "Appartement" => "Apartments",
                "Bureau" => "Office",
                "Villa" => "Villa"
            ]),
            CollectionField::new('picture')
                ->setTemplatePath('bundles/EasyAdminBundle/page/picture.html.twig')
                ->useEntryCrudForm(),
            // ->allowAdd()
            // ->allowDelete()
            // ->setEntryType(CollectionType::class),
            MoneyField::new('prop_price')->setCurrency('EUR'),
            ArrayField::new('feature'),



        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(ChoiceFilter::new("prop_housing_type", "Type de propriété")->setChoices([
                "Maison" => "Houses",
                "Appartement" => "Apartments",
                "Bureau" => "Office",
                "Villa" => "Villa"
            ]))
            ->add(NumericFilter::new("prop_nb_rooms", "Nombre de chambres"))
            ->add(NumericFilter::new("prop_sqm", "Nombre de mètres carrés"))
            ->add(NumericFilter::new("prop_price", "Prix"))
            ->add(NumericFilter::new("prop_nb_beds", "Nombre de baignoires"))
            ->add(NumericFilter::new("prop_nb_spaces", "Nombre de places de parking"))
            ->add(BooleanFilter::new("prop_furnished", "Meublé ou non ?"))
        ;
    }

}
