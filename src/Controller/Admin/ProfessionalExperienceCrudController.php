<?php

namespace App\Controller\Admin;

use App\Entity\ProfessionalExperience;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProfessionalExperienceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProfessionalExperience::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
