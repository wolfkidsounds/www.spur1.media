<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226154100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crew ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE crew ADD CONSTRAINT FK_894940B28BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_894940B28BAC62AF ON crew (city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crew DROP FOREIGN KEY FK_894940B28BAC62AF');
        $this->addSql('DROP INDEX IDX_894940B28BAC62AF ON crew');
        $this->addSql('ALTER TABLE crew DROP city_id');
    }
}
