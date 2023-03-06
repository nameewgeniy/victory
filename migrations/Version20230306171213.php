<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306171213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP CONSTRAINT fk_5a8a6c8d93cb796c');
        $this->addSql('DROP SEQUENCE video_file_id_seq CASCADE');
        $this->addSql('DROP TABLE video_file');
        $this->addSql('DROP INDEX uniq_5a8a6c8d93cb796c');
        $this->addSql('ALTER TABLE post ADD file VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE post DROP file_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE video_file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE video_file (id INT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE post ADD file_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post DROP file');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT fk_5a8a6c8d93cb796c FOREIGN KEY (file_id) REFERENCES video_file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_5a8a6c8d93cb796c ON post (file_id)');
    }
}
