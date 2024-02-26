<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226151810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE act_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, artist_type_id INT NOT NULL, city_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', description LONGTEXT DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_verified TINYINT(1) DEFAULT NULL, tourbox VARCHAR(255) DEFAULT NULL, INDEX IDX_15996877203D2A4 (artist_type_id), INDEX IDX_15996878BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_user (artist_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_312D50D6B7970CF8 (artist_id), INDEX IDX_312D50D6A76ED395 (user_id), PRIMARY KEY(artist_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_gender (artist_id INT NOT NULL, gender_id INT NOT NULL, INDEX IDX_3545063CB7970CF8 (artist_id), INDEX IDX_3545063C708A0E0 (gender_id), PRIMARY KEY(artist_id, gender_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_act_type (artist_id INT NOT NULL, act_type_id INT NOT NULL, INDEX IDX_FC5D5C9DB7970CF8 (artist_id), INDEX IDX_FC5D5C9DB9646739 (act_type_id), PRIMARY KEY(artist_id, act_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, state_id INT DEFAULT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, geonames VARCHAR(255) NOT NULL, INDEX IDX_2D5B02345D83CC1 (state_id), INDEX IDX_2D5B0234F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', description LONGTEXT DEFAULT NULL, maps_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crew (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', description LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_verified TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crew_artist (crew_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_856AE6685FE259F6 (crew_id), INDEX IDX_856AE668B7970CF8 (artist_id), PRIMARY KEY(crew_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crew_user (crew_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B4AF30565FE259F6 (crew_id), INDEX IDX_B4AF3056A76ED395 (user_id), PRIMARY KEY(crew_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE easy_media__folder (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, INDEX IDX_1C446171727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE easy_media__media (id INT AUTO_INCREMENT NOT NULL, folder_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, mime VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, last_modified INT DEFAULT NULL, metas JSON NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_83D7599C162CB942 (folder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, artist_id INT DEFAULT NULL, crew_id INT DEFAULT NULL, post_id INT DEFAULT NULL, club_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_36AC99F1C54C8C93 (type_id), INDEX IDX_36AC99F1B7970CF8 (artist_id), INDEX IDX_36AC99F15FE259F6 (crew_id), INDEX IDX_36AC99F14B89032C (post_id), INDEX IDX_36AC99F161190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, maps_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, location_id INT DEFAULT NULL, club_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', date DATE NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', audio_file TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', post_type VARCHAR(255) NOT NULL, you_tube_url VARCHAR(255) DEFAULT NULL, mixcloud_url VARCHAR(255) DEFAULT NULL, INDEX IDX_5A8A6C8DA76ED395 (user_id), INDEX IDX_5A8A6C8D64D218E (location_id), INDEX IDX_5A8A6C8D61190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_tag (post_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_5ACE3AF04B89032C (post_id), INDEX IDX_5ACE3AF0BAD26311 (tag_id), PRIMARY KEY(post_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_artist (post_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_317B72E24B89032C (post_id), INDEX IDX_317B72E2B7970CF8 (artist_id), PRIMARY KEY(post_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_crew (post_id INT NOT NULL, crew_id INT NOT NULL, INDEX IDX_401C27B94B89032C (post_id), INDEX IDX_401C27B95FE259F6 (crew_id), PRIMARY KEY(post_id, crew_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, geonames VARCHAR(255) NOT NULL, INDEX IDX_A393D2FBF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, format_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_389B783D629F605 (format_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_format (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_15996877203D2A4 FOREIGN KEY (artist_type_id) REFERENCES artist_type (id)');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_15996878BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE artist_user ADD CONSTRAINT FK_312D50D6B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_user ADD CONSTRAINT FK_312D50D6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_gender ADD CONSTRAINT FK_3545063CB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_gender ADD CONSTRAINT FK_3545063C708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_act_type ADD CONSTRAINT FK_FC5D5C9DB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_act_type ADD CONSTRAINT FK_FC5D5C9DB9646739 FOREIGN KEY (act_type_id) REFERENCES act_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B02345D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE crew_artist ADD CONSTRAINT FK_856AE6685FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crew_artist ADD CONSTRAINT FK_856AE668B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crew_user ADD CONSTRAINT FK_B4AF30565FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crew_user ADD CONSTRAINT FK_B4AF3056A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE easy_media__folder ADD CONSTRAINT FK_1C446171727ACA70 FOREIGN KEY (parent_id) REFERENCES easy_media__folder (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE easy_media__media ADD CONSTRAINT FK_83D7599C162CB942 FOREIGN KEY (folder_id) REFERENCES easy_media__folder (id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1C54C8C93 FOREIGN KEY (type_id) REFERENCES link_type (id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F15FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F14B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F161190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF04B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF0BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_artist ADD CONSTRAINT FK_317B72E24B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_artist ADD CONSTRAINT FK_317B72E2B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_crew ADD CONSTRAINT FK_401C27B94B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_crew ADD CONSTRAINT FK_401C27B95FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE state ADD CONSTRAINT FK_A393D2FBF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783D629F605 FOREIGN KEY (format_id) REFERENCES tag_format (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_15996877203D2A4');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_15996878BAC62AF');
        $this->addSql('ALTER TABLE artist_user DROP FOREIGN KEY FK_312D50D6B7970CF8');
        $this->addSql('ALTER TABLE artist_user DROP FOREIGN KEY FK_312D50D6A76ED395');
        $this->addSql('ALTER TABLE artist_gender DROP FOREIGN KEY FK_3545063CB7970CF8');
        $this->addSql('ALTER TABLE artist_gender DROP FOREIGN KEY FK_3545063C708A0E0');
        $this->addSql('ALTER TABLE artist_act_type DROP FOREIGN KEY FK_FC5D5C9DB7970CF8');
        $this->addSql('ALTER TABLE artist_act_type DROP FOREIGN KEY FK_FC5D5C9DB9646739');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B02345D83CC1');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234F92F3E70');
        $this->addSql('ALTER TABLE crew_artist DROP FOREIGN KEY FK_856AE6685FE259F6');
        $this->addSql('ALTER TABLE crew_artist DROP FOREIGN KEY FK_856AE668B7970CF8');
        $this->addSql('ALTER TABLE crew_user DROP FOREIGN KEY FK_B4AF30565FE259F6');
        $this->addSql('ALTER TABLE crew_user DROP FOREIGN KEY FK_B4AF3056A76ED395');
        $this->addSql('ALTER TABLE easy_media__folder DROP FOREIGN KEY FK_1C446171727ACA70');
        $this->addSql('ALTER TABLE easy_media__media DROP FOREIGN KEY FK_83D7599C162CB942');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F1C54C8C93');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F1B7970CF8');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F15FE259F6');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F14B89032C');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F161190A32');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D64D218E');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D61190A32');
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF04B89032C');
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF0BAD26311');
        $this->addSql('ALTER TABLE post_artist DROP FOREIGN KEY FK_317B72E24B89032C');
        $this->addSql('ALTER TABLE post_artist DROP FOREIGN KEY FK_317B72E2B7970CF8');
        $this->addSql('ALTER TABLE post_crew DROP FOREIGN KEY FK_401C27B94B89032C');
        $this->addSql('ALTER TABLE post_crew DROP FOREIGN KEY FK_401C27B95FE259F6');
        $this->addSql('ALTER TABLE state DROP FOREIGN KEY FK_A393D2FBF92F3E70');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783D629F605');
        $this->addSql('DROP TABLE act_type');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE artist_user');
        $this->addSql('DROP TABLE artist_gender');
        $this->addSql('DROP TABLE artist_act_type');
        $this->addSql('DROP TABLE artist_type');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE crew');
        $this->addSql('DROP TABLE crew_artist');
        $this->addSql('DROP TABLE crew_user');
        $this->addSql('DROP TABLE easy_media__folder');
        $this->addSql('DROP TABLE easy_media__media');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE link');
        $this->addSql('DROP TABLE link_type');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_tag');
        $this->addSql('DROP TABLE post_artist');
        $this->addSql('DROP TABLE post_crew');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_format');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
