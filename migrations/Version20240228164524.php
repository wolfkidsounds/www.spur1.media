<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240228164524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE claim_request (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, user_id INT NOT NULL, info LONGTEXT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_AA6C60A1B7970CF8 (artist_id), INDEX IDX_AA6C60A1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE verification_request (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, user_id INT NOT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_20FDDF4EB7970CF8 (artist_id), INDEX IDX_20FDDF4EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE claim_request ADD CONSTRAINT FK_AA6C60A1B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE claim_request ADD CONSTRAINT FK_AA6C60A1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE verification_request ADD CONSTRAINT FK_20FDDF4EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE verification_request ADD CONSTRAINT FK_20FDDF4EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE claim_request DROP FOREIGN KEY FK_AA6C60A1B7970CF8');
        $this->addSql('ALTER TABLE claim_request DROP FOREIGN KEY FK_AA6C60A1A76ED395');
        $this->addSql('ALTER TABLE verification_request DROP FOREIGN KEY FK_20FDDF4EB7970CF8');
        $this->addSql('ALTER TABLE verification_request DROP FOREIGN KEY FK_20FDDF4EA76ED395');
        $this->addSql('DROP TABLE claim_request');
        $this->addSql('DROP TABLE verification_request');
    }
}
