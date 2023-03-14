<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314064631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD teaser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA77ADE9C9E FOREIGN KEY (teaser_id) REFERENCES teaser (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3BAE0AA74B89032C ON event (post_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA77ADE9C9E ON event (teaser_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE event DROP CONSTRAINT FK_3BAE0AA74B89032C');
        $this->addSql('ALTER TABLE event DROP CONSTRAINT FK_3BAE0AA77ADE9C9E');
        $this->addSql('DROP INDEX IDX_3BAE0AA74B89032C');
        $this->addSql('DROP INDEX IDX_3BAE0AA77ADE9C9E');
        $this->addSql('ALTER TABLE event DROP post_id');
        $this->addSql('ALTER TABLE event DROP teaser_id');
    }
}
