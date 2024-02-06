<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240203203504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, post_type VARCHAR(255) NOT NULL, you_tube_url VARCHAR(255) DEFAULT NULL, mixcloud_url VARCHAR(255) DEFAULT NULL, INDEX IDX_5A8A6C8D64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_tag (post_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_5ACE3AF04B89032C (post_id), INDEX IDX_5ACE3AF0BAD26311 (tag_id), PRIMARY KEY(post_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_artist (post_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_317B72E24B89032C (post_id), INDEX IDX_317B72E2B7970CF8 (artist_id), PRIMARY KEY(post_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF04B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF0BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_artist ADD CONSTRAINT FK_317B72E24B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_artist ADD CONSTRAINT FK_317B72E2B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orbiter_session_artist DROP FOREIGN KEY FK_D2BB4E6CB7970CF8');
        $this->addSql('ALTER TABLE orbiter_session_artist DROP FOREIGN KEY FK_D2BB4E6CD17E09A');
        $this->addSql('ALTER TABLE orbiter_session_tag DROP FOREIGN KEY FK_788AB2AAD17E09A');
        $this->addSql('ALTER TABLE orbiter_session_tag DROP FOREIGN KEY FK_788AB2AABAD26311');
        $this->addSql('ALTER TABLE radio_artist DROP FOREIGN KEY FK_66FF1F645B94ADD2');
        $this->addSql('ALTER TABLE radio_artist DROP FOREIGN KEY FK_66FF1F64B7970CF8');
        $this->addSql('ALTER TABLE radio_tag DROP FOREIGN KEY FK_DBF8455B94ADD2');
        $this->addSql('ALTER TABLE radio_tag DROP FOREIGN KEY FK_DBF845BAD26311');
        $this->addSql('ALTER TABLE teletime_artist DROP FOREIGN KEY FK_441D4D4CB7970CF8');
        $this->addSql('ALTER TABLE teletime_artist DROP FOREIGN KEY FK_441D4D4CF3688183');
        $this->addSql('ALTER TABLE teletime_tag DROP FOREIGN KEY FK_1C1F650BBAD26311');
        $this->addSql('ALTER TABLE teletime_tag DROP FOREIGN KEY FK_1C1F650BF3688183');
        $this->addSql('ALTER TABLE windowlicker DROP FOREIGN KEY FK_CEBF97B364D218E');
        $this->addSql('ALTER TABLE windowlicker_artist DROP FOREIGN KEY FK_ED910432B7970CF8');
        $this->addSql('ALTER TABLE windowlicker_artist DROP FOREIGN KEY FK_ED910432C4873777');
        $this->addSql('ALTER TABLE windowlicker_tag DROP FOREIGN KEY FK_A6F8BCB8C4873777');
        $this->addSql('ALTER TABLE windowlicker_tag DROP FOREIGN KEY FK_A6F8BCB8BAD26311');
        $this->addSql('DROP TABLE orbiter_session');
        $this->addSql('DROP TABLE orbiter_session_artist');
        $this->addSql('DROP TABLE orbiter_session_tag');
        $this->addSql('DROP TABLE radio');
        $this->addSql('DROP TABLE radio_artist');
        $this->addSql('DROP TABLE radio_tag');
        $this->addSql('DROP TABLE teletime');
        $this->addSql('DROP TABLE teletime_artist');
        $this->addSql('DROP TABLE teletime_tag');
        $this->addSql('DROP TABLE windowlicker');
        $this->addSql('DROP TABLE windowlicker_artist');
        $this->addSql('DROP TABLE windowlicker_tag');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orbiter_session (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, you_tube_url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE orbiter_session_artist (orbiter_session_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_D2BB4E6CB7970CF8 (artist_id), INDEX IDX_D2BB4E6CD17E09A (orbiter_session_id), PRIMARY KEY(orbiter_session_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE orbiter_session_tag (orbiter_session_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_788AB2AABAD26311 (tag_id), INDEX IDX_788AB2AAD17E09A (orbiter_session_id), PRIMARY KEY(orbiter_session_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE radio (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, you_tube_url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, mixcloud_url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE radio_artist (radio_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_66FF1F645B94ADD2 (radio_id), INDEX IDX_66FF1F64B7970CF8 (artist_id), PRIMARY KEY(radio_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE radio_tag (radio_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_DBF845BAD26311 (tag_id), INDEX IDX_DBF8455B94ADD2 (radio_id), PRIMARY KEY(radio_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE teletime (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, you_tube_url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE teletime_artist (teletime_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_441D4D4CF3688183 (teletime_id), INDEX IDX_441D4D4CB7970CF8 (artist_id), PRIMARY KEY(teletime_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE teletime_tag (teletime_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_1C1F650BF3688183 (teletime_id), INDEX IDX_1C1F650BBAD26311 (tag_id), PRIMARY KEY(teletime_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE windowlicker (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, you_tube_url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_CEBF97B364D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE windowlicker_artist (windowlicker_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_ED910432C4873777 (windowlicker_id), INDEX IDX_ED910432B7970CF8 (artist_id), PRIMARY KEY(windowlicker_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE windowlicker_tag (windowlicker_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_A6F8BCB8C4873777 (windowlicker_id), INDEX IDX_A6F8BCB8BAD26311 (tag_id), PRIMARY KEY(windowlicker_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE orbiter_session_artist ADD CONSTRAINT FK_D2BB4E6CB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orbiter_session_artist ADD CONSTRAINT FK_D2BB4E6CD17E09A FOREIGN KEY (orbiter_session_id) REFERENCES orbiter_session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orbiter_session_tag ADD CONSTRAINT FK_788AB2AAD17E09A FOREIGN KEY (orbiter_session_id) REFERENCES orbiter_session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orbiter_session_tag ADD CONSTRAINT FK_788AB2AABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE radio_artist ADD CONSTRAINT FK_66FF1F645B94ADD2 FOREIGN KEY (radio_id) REFERENCES radio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE radio_artist ADD CONSTRAINT FK_66FF1F64B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE radio_tag ADD CONSTRAINT FK_DBF8455B94ADD2 FOREIGN KEY (radio_id) REFERENCES radio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE radio_tag ADD CONSTRAINT FK_DBF845BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teletime_artist ADD CONSTRAINT FK_441D4D4CB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teletime_artist ADD CONSTRAINT FK_441D4D4CF3688183 FOREIGN KEY (teletime_id) REFERENCES teletime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teletime_tag ADD CONSTRAINT FK_1C1F650BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teletime_tag ADD CONSTRAINT FK_1C1F650BF3688183 FOREIGN KEY (teletime_id) REFERENCES teletime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE windowlicker ADD CONSTRAINT FK_CEBF97B364D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE windowlicker_artist ADD CONSTRAINT FK_ED910432B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE windowlicker_artist ADD CONSTRAINT FK_ED910432C4873777 FOREIGN KEY (windowlicker_id) REFERENCES windowlicker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE windowlicker_tag ADD CONSTRAINT FK_A6F8BCB8C4873777 FOREIGN KEY (windowlicker_id) REFERENCES windowlicker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE windowlicker_tag ADD CONSTRAINT FK_A6F8BCB8BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D64D218E');
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF04B89032C');
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF0BAD26311');
        $this->addSql('ALTER TABLE post_artist DROP FOREIGN KEY FK_317B72E24B89032C');
        $this->addSql('ALTER TABLE post_artist DROP FOREIGN KEY FK_317B72E2B7970CF8');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_tag');
        $this->addSql('DROP TABLE post_artist');
    }
}
