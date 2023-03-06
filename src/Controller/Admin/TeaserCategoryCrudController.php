<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\TeaserCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TeaserCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TeaserCategory::class;
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
