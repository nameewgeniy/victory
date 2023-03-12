<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230312130707 extends AbstractMigration
{
    private array $categories = [
        'Юмор',
        'Проишествия',
        'Шоу-биз',
        'Новости/политика',
        'Здоровье',
    ];

    private array $teaserCategories = [
        'Адалт',
        'Грибок',
        'Гипертония',
        'Потенция',
        'Крипта',
        'Простатит',
        'Омоложение',
    ];

    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $id = 1001;
        foreach ($this->categories as $name) {
            $query = sprintf(
                "insert into post_category (id, name) VALUES ('%s', '%s')",
                $id++,
                $name,
            );
            $this->addSql($query);
        }

        $id = 1001;
        foreach ($this->teaserCategories as $name) {
            $query = sprintf(
                "insert into teaser_category (id, name) VALUES ('%s', '%s')",
                $id++,
                $name,
            );
            $this->addSql($query);
        }
    }

    public function down(Schema $schema): void
    {
        foreach ($this->categories as $name) {
            $this->addSql(sprintf("DELETE FROM post_category WHERE name = '%s'", $name));
        }

        foreach ($this->teaserCategories as $name) {
            $this->addSql(sprintf("DELETE FROM teaser_category WHERE name = '%s'", $name));
        }
    }
}
