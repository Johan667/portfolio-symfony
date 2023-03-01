<?php

namespace App\Controller\Admin;

use App\Entity\Achievements;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AchievementsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Achievements::class;
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
