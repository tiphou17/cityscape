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
            IntegerField::new('propNbBeds'),
            IntegerField::new('propNbBaths'),
            IntegerField::new('propNbSpaces'),
            IntegerField::new('propNbRooms'),
            IntegerField::new('propSqm'),
            BooleanField::new('propFurnished'),
            ChoiceField::new('propHousingType')->setChoices([
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
            MoneyField::new('propPrice')->setCurrency('EUR'),
            ArrayField::new('feature'),



        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(ChoiceFilter::new("propHousingType", "Type de propriété")->setChoices([
                "Maison" => "Houses",
                "Appartement" => "Apartments",
                "Bureau" => "Office",
                "Villa" => "Villa"
            ]))
            ->add(NumericFilter::new("propNbRooms", "Nombre de chambres"))
            ->add(NumericFilter::new("propSqm", "Nombre de mètres carrés"))
            ->add(NumericFilter::new("propPrice", "Prix"))
            ->add(NumericFilter::new("propNbBeds", "Nombre de baignoires"))
            ->add(NumericFilter::new("propNbSpaces", "Nombre de places de parking"))
            ->add(BooleanFilter::new("propFurnished", "Meublé ou non ?"))
        ;
    }

}
