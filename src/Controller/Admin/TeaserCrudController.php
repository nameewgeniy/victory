<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Teaser;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class TeaserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Teaser::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('groupId')
                ->setLabel('Название кампании'),
            UrlField::new('url'),
            AssociationField::new('category')
                ->setFormTypeOption('by_reference', false),
            ImageField::new('file')
                ->setUploadedFileNamePattern('files/[slug]-[contenthash].[extension]')
                ->setUploadDir('public/files'),
            ArrayField::new('blockIp'),
        ];
    }
}
