<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240121033058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE radio ADD artist_id INT NOT NULL');
        $this->addSql('ALTER TABLE radio ADD CONSTRAINT FK_E0461B0FB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_E0461B0FB7970CF8 ON radio (artist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE radio DROP FOREIGN KEY FK_E0461B0FB7970CF8');
        $this->addSql('DROP INDEX IDX_E0461B0FB7970CF8 ON radio');
        $this->addSql('ALTER TABLE radio DROP artist_id');
    }
}
