<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
public function configureCrud(Crud $crud): Crud
{
    return $crud->setEntityPermission('ROLE_ADMIN');
}
  
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email'),
            TextField::new('password')->setPermission('ROLE_SUPER_ADMIN'),
            ArrayField::new('roles'),
        ];
    }
 public function configureActions(Actions $actions): Actions
 {
    // return $actions->setPermission(Action::DELETE,'ROLE_SUPER_ADMIN');
    //return $actions->remove(ACTION::INDEX,Action::DELETE);
    return $actions->disable(Action::DELETE)->setPermission(Action::EDIT,'ROLE_SUPER_ADMIN');
 }
    # code...
}
    

