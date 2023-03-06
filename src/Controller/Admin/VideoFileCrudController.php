<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\VideoFile;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VideoFileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VideoFile::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            ImageField::new('path')
                ->setUploadedFileNamePattern('[year]/[month]/[day]/[slug]-[contenthash].[extension]')
                ->setUploadDir('public/files'),
        ];
    }
}
