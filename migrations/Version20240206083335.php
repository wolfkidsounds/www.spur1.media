<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206083335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE crew (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', description LONGTEXT DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, you_tube_url VARCHAR(255) DEFAULT NULL, soundcloud_url VARCHAR(255) DEFAULT NULL, facebook_url VARCHAR(255) DEFAULT NULL, instagram_url VARCHAR(255) DEFAULT NULL, linktree_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crew_artist (crew_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_856AE6685FE259F6 (crew_id), INDEX IDX_856AE668B7970CF8 (artist_id), PRIMARY KEY(crew_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crew_post (crew_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_63B68A925FE259F6 (crew_id), INDEX IDX_63B68A924B89032C (post_id), PRIMARY KEY(crew_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crew_user (crew_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B4AF30565FE259F6 (crew_id), INDEX IDX_B4AF3056A76ED395 (user_id), PRIMARY KEY(crew_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crew_artist ADD CONSTRAINT FK_856AE6685FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crew_artist ADD CONSTRAINT FK_856AE668B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crew_post ADD CONSTRAINT FK_63B68A925FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crew_post ADD CONSTRAINT FK_63B68A924B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crew_user ADD CONSTRAINT FK_B4AF30565FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crew_user ADD CONSTRAINT FK_B4AF3056A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist CHANGE image image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\'');
        $this->addSql('ALTER TABLE post CHANGE image image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\'');
        $this->addSql('ALTER TABLE user CHANGE image image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crew_artist DROP FOREIGN KEY FK_856AE6685FE259F6');
        $this->addSql('ALTER TABLE crew_artist DROP FOREIGN KEY FK_856AE668B7970CF8');
        $this->addSql('ALTER TABLE crew_post DROP FOREIGN KEY FK_63B68A925FE259F6');
        $this->addSql('ALTER TABLE crew_post DROP FOREIGN KEY FK_63B68A924B89032C');
        $this->addSql('ALTER TABLE crew_user DROP FOREIGN KEY FK_B4AF30565FE259F6');
        $this->addSql('ALTER TABLE crew_user DROP FOREIGN KEY FK_B4AF3056A76ED395');
        $this->addSql('DROP TABLE crew');
        $this->addSql('DROP TABLE crew_artist');
        $this->addSql('DROP TABLE crew_post');
        $this->addSql('DROP TABLE crew_user');
        $this->addSql('ALTER TABLE artist CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE post CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE image image VARCHAR(255) DEFAULT NULL');
    }
}
