<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129005632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE teletime (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, you_tube_url VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, date DATE NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teletime_artist (teletime_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_441D4D4CF3688183 (teletime_id), INDEX IDX_441D4D4CB7970CF8 (artist_id), PRIMARY KEY(teletime_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teletime_tag (teletime_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_1C1F650BF3688183 (teletime_id), INDEX IDX_1C1F650BBAD26311 (tag_id), PRIMARY KEY(teletime_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE teletime_artist ADD CONSTRAINT FK_441D4D4CF3688183 FOREIGN KEY (teletime_id) REFERENCES teletime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teletime_artist ADD CONSTRAINT FK_441D4D4CB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teletime_tag ADD CONSTRAINT FK_1C1F650BF3688183 FOREIGN KEY (teletime_id) REFERENCES teletime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teletime_tag ADD CONSTRAINT FK_1C1F650BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teletime_artist DROP FOREIGN KEY FK_441D4D4CF3688183');
        $this->addSql('ALTER TABLE teletime_artist DROP FOREIGN KEY FK_441D4D4CB7970CF8');
        $this->addSql('ALTER TABLE teletime_tag DROP FOREIGN KEY FK_1C1F650BF3688183');
        $this->addSql('ALTER TABLE teletime_tag DROP FOREIGN KEY FK_1C1F650BBAD26311');
        $this->addSql('DROP TABLE teletime');
        $this->addSql('DROP TABLE teletime_artist');
        $this->addSql('DROP TABLE teletime_tag');
    }
}
