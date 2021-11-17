<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CurrencyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }
   
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityPermission('ROLE_ADMIN','ROLE_USER','ROLE_SUPER_ADMIN');
        
    }
    
       
   
    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('name'),
            //TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
            AssociationField::new('category'),
            BooleanField::new('status'),
            NumberField::new('price'),
            //ImageField::new('imageFile')->setBasePath($this->getParameter("app.path.product_images"))->onlyOnIndex(),
            //TextareaField::new('imageFile','update you image')->setFormType(VichImageType::class)->onlyWhenUpdating(),

            ImageField::new('image',"product image")->setBasePath('/uploads/images/products/')->setUploadDir('/public/uploads/images/products/')->setUploadedFileNamePattern('[randomhash],[extension]')->setRequired(false),
         TextField::new('description'),
        ];}
       
    }
  
       

