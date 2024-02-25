<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240224184701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE387264D218E');
        $this->addSql('DROP INDEX UNIQ_B8EE387264D218E ON club');
        $this->addSql('ALTER TABLE club ADD maps_url VARCHAR(255) DEFAULT NULL, DROP location_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club ADD location_id INT NOT NULL, DROP maps_url');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE387264D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE387264D218E ON club (location_id)');
    }
}
