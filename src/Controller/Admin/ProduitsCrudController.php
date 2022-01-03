<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProduitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produits::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('nomp'),
            TextField::new('quantite'),
            
            AssociationField::new('categories'),
            ImageField::new('image',"product image")->setBasePath('/uploads/images/products/')->setUploadDir('/public/uploads/images/products/')->setUploadedFileNamePattern('[randomhash].[extension]')->setRequired(false),
            
        ];
    }
    
}
