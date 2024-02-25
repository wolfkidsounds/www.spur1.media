<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240224183030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, name VARCHAR(255) NOT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_B8EE387264D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interview (id INT AUTO_INCREMENT NOT NULL, you_tube_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rec_session (id INT AUTO_INCREMENT NOT NULL, you_tube_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE387264D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE link ADD club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F161190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_36AC99F161190A32 ON link (club_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F161190A32');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE387264D218E');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE interview');
        $this->addSql('DROP TABLE rec_session');
        $this->addSql('DROP INDEX IDX_36AC99F161190A32 ON link');
        $this->addSql('ALTER TABLE link DROP club_id');
    }
}
