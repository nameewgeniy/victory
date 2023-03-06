<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306163438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE post_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE video_file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE post_category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE post_category_post (post_category_id INT NOT NULL, post_id INT NOT NULL, PRIMARY KEY(post_category_id, post_id))');
        $this->addSql('CREATE INDEX IDX_CE60A8D9FE0617CD ON post_category_post (post_category_id)');
        $this->addSql('CREATE INDEX IDX_CE60A8D94B89032C ON post_category_post (post_id)');
        $this->addSql('CREATE TABLE video_file (id INT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE post_category_post ADD CONSTRAINT FK_CE60A8D9FE0617CD FOREIGN KEY (post_category_id) REFERENCES post_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_category_post ADD CONSTRAINT FK_CE60A8D94B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D7E3C61F9 ON post (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE post_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE video_file_id_seq CASCADE');
        $this->addSql('ALTER TABLE post_category_post DROP CONSTRAINT FK_CE60A8D9FE0617CD');
        $this->addSql('ALTER TABLE post_category_post DROP CONSTRAINT FK_CE60A8D94B89032C');
        $this->addSql('DROP TABLE post_category');
        $this->addSql('DROP TABLE post_category_post');
        $this->addSql('DROP TABLE video_file');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D7E3C61F9');
        $this->addSql('DROP INDEX IDX_5A8A6C8D7E3C61F9');
        $this->addSql('ALTER TABLE post DROP owner_id');
    }
}
