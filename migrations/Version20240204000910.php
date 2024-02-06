<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204000910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_15996878BAC62AF');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687F92F3E70');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_15996875D83CC1');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B02345D83CC1');
        $this->addSql('ALTER TABLE state DROP FOREIGN KEY FK_A393D2FBF92F3E70');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP INDEX IDX_1599687F92F3E70 ON artist');
        $this->addSql('DROP INDEX IDX_15996875D83CC1 ON artist');
        $this->addSql('DROP INDEX IDX_15996878BAC62AF ON artist');
        $this->addSql('ALTER TABLE artist ADD country VARCHAR(255) NOT NULL, ADD state VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, DROP country_id, DROP state_id, DROP city_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, state_id INT NOT NULL, INDEX IDX_2D5B02345D83CC1 (state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, INDEX IDX_A393D2FBF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B02345D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE state ADD CONSTRAINT FK_A393D2FBF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE artist ADD country_id INT DEFAULT NULL, ADD state_id INT DEFAULT NULL, ADD city_id INT DEFAULT NULL, DROP country, DROP state, DROP city');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_15996878BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_15996875D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('CREATE INDEX IDX_1599687F92F3E70 ON artist (country_id)');
        $this->addSql('CREATE INDEX IDX_15996875D83CC1 ON artist (state_id)');
        $this->addSql('CREATE INDEX IDX_15996878BAC62AF ON artist (city_id)');
    }
}
