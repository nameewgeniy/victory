<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314060246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP view');
        $this->addSql('ALTER TABLE event DROP start');
        $this->addSql('ALTER TABLE event DROP quartile');
        $this->addSql('ALTER TABLE event DROP teaser_view');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE event ADD view INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD start INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD quartile INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD teaser_view INT DEFAULT NULL');
    }
}
