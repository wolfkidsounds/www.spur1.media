<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122212740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE radio_artist (radio_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_66FF1F645B94ADD2 (radio_id), INDEX IDX_66FF1F64B7970CF8 (artist_id), PRIMARY KEY(radio_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE radio_artist ADD CONSTRAINT FK_66FF1F645B94ADD2 FOREIGN KEY (radio_id) REFERENCES radio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE radio_artist ADD CONSTRAINT FK_66FF1F64B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE radio DROP FOREIGN KEY FK_E0461B0FB7970CF8');
        $this->addSql('DROP INDEX IDX_E0461B0FB7970CF8 ON radio');
        $this->addSql('ALTER TABLE radio DROP artist_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE radio_artist DROP FOREIGN KEY FK_66FF1F645B94ADD2');
        $this->addSql('ALTER TABLE radio_artist DROP FOREIGN KEY FK_66FF1F64B7970CF8');
        $this->addSql('DROP TABLE radio_artist');
        $this->addSql('ALTER TABLE radio ADD artist_id INT NOT NULL');
        $this->addSql('ALTER TABLE radio ADD CONSTRAINT FK_E0461B0FB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_E0461B0FB7970CF8 ON radio (artist_id)');
    }
}
