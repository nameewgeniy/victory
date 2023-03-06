<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306172006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE teaser_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE teaser_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE teaser (id INT NOT NULL, name VARCHAR(255) NOT NULL, group_id VARCHAR(255) DEFAULT NULL, file VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE teaser_teaser_category (teaser_id INT NOT NULL, teaser_category_id INT NOT NULL, PRIMARY KEY(teaser_id, teaser_category_id))');
        $this->addSql('CREATE INDEX IDX_8C00ABB47ADE9C9E ON teaser_teaser_category (teaser_id)');
        $this->addSql('CREATE INDEX IDX_8C00ABB447605ABA ON teaser_teaser_category (teaser_category_id)');
        $this->addSql('CREATE TABLE teaser_category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE teaser_teaser_category ADD CONSTRAINT FK_8C00ABB47ADE9C9E FOREIGN KEY (teaser_id) REFERENCES teaser (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE teaser_teaser_category ADD CONSTRAINT FK_8C00ABB447605ABA FOREIGN KEY (teaser_category_id) REFERENCES teaser_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE teaser_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE teaser_category_id_seq CASCADE');
        $this->addSql('ALTER TABLE teaser_teaser_category DROP CONSTRAINT FK_8C00ABB47ADE9C9E');
        $this->addSql('ALTER TABLE teaser_teaser_category DROP CONSTRAINT FK_8C00ABB447605ABA');
        $this->addSql('DROP TABLE teaser');
        $this->addSql('DROP TABLE teaser_teaser_category');
        $this->addSql('DROP TABLE teaser_category');
    }
}
