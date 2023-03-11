<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230311060632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_teaser_category (post_id INT NOT NULL, teaser_category_id INT NOT NULL, PRIMARY KEY(post_id, teaser_category_id))');
        $this->addSql('CREATE INDEX IDX_83B0EA0B4B89032C ON post_teaser_category (post_id)');
        $this->addSql('CREATE INDEX IDX_83B0EA0B47605ABA ON post_teaser_category (teaser_category_id)');
        $this->addSql('ALTER TABLE post_teaser_category ADD CONSTRAINT FK_83B0EA0B4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_teaser_category ADD CONSTRAINT FK_83B0EA0B47605ABA FOREIGN KEY (teaser_category_id) REFERENCES teaser_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE teaser ADD url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE teaser ADD block_ip JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE post_teaser_category DROP CONSTRAINT FK_83B0EA0B4B89032C');
        $this->addSql('ALTER TABLE post_teaser_category DROP CONSTRAINT FK_83B0EA0B47605ABA');
        $this->addSql('DROP TABLE post_teaser_category');
        $this->addSql('ALTER TABLE teaser DROP url');
        $this->addSql('ALTER TABLE teaser DROP block_ip');
    }
}
