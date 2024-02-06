<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124184123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, maps_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE radio DROP embed');
        $this->addSql('ALTER TABLE windowlicker ADD location_id INT DEFAULT NULL, DROP embed');
        $this->addSql('ALTER TABLE windowlicker ADD CONSTRAINT FK_CEBF97B364D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_CEBF97B364D218E ON windowlicker (location_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE windowlicker DROP FOREIGN KEY FK_CEBF97B364D218E');
        $this->addSql('DROP TABLE location');
        $this->addSql('ALTER TABLE radio ADD embed LONGTEXT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_CEBF97B364D218E ON windowlicker');
        $this->addSql('ALTER TABLE windowlicker ADD embed LONGTEXT DEFAULT NULL, DROP location_id');
    }
}
