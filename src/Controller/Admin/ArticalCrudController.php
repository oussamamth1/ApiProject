<?php

namespace App\Controller\Admin;

use App\Entity\Artical;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artical::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('name'),
            
        ];
    }
    
}
