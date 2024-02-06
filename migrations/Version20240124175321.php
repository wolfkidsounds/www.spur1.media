<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124175321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE windowlicker (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, you_tube_url VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, embed LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE windowlicker_artist (windowlicker_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_ED910432C4873777 (windowlicker_id), INDEX IDX_ED910432B7970CF8 (artist_id), PRIMARY KEY(windowlicker_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE windowlicker_tag (windowlicker_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_A6F8BCB8C4873777 (windowlicker_id), INDEX IDX_A6F8BCB8BAD26311 (tag_id), PRIMARY KEY(windowlicker_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE windowlicker_artist ADD CONSTRAINT FK_ED910432C4873777 FOREIGN KEY (windowlicker_id) REFERENCES windowlicker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE windowlicker_artist ADD CONSTRAINT FK_ED910432B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE windowlicker_tag ADD CONSTRAINT FK_A6F8BCB8C4873777 FOREIGN KEY (windowlicker_id) REFERENCES windowlicker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE windowlicker_tag ADD CONSTRAINT FK_A6F8BCB8BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE radio ADD embed LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783D629F605 FOREIGN KEY (format_id) REFERENCES tag_format (id)');
        $this->addSql('CREATE INDEX IDX_389B783D629F605 ON tag (format_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE windowlicker_artist DROP FOREIGN KEY FK_ED910432C4873777');
        $this->addSql('ALTER TABLE windowlicker_artist DROP FOREIGN KEY FK_ED910432B7970CF8');
        $this->addSql('ALTER TABLE windowlicker_tag DROP FOREIGN KEY FK_A6F8BCB8C4873777');
        $this->addSql('ALTER TABLE windowlicker_tag DROP FOREIGN KEY FK_A6F8BCB8BAD26311');
        $this->addSql('DROP TABLE windowlicker');
        $this->addSql('DROP TABLE windowlicker_artist');
        $this->addSql('DROP TABLE windowlicker_tag');
        $this->addSql('ALTER TABLE radio DROP embed');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783D629F605');
        $this->addSql('DROP INDEX IDX_389B783D629F605 ON tag');
    }
}
