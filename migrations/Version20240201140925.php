<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201140925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orbiter_session (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, you_tube_url VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orbiter_session_artist (orbiter_session_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_D2BB4E6CD17E09A (orbiter_session_id), INDEX IDX_D2BB4E6CB7970CF8 (artist_id), PRIMARY KEY(orbiter_session_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orbiter_session_tag (orbiter_session_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_788AB2AAD17E09A (orbiter_session_id), INDEX IDX_788AB2AABAD26311 (tag_id), PRIMARY KEY(orbiter_session_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orbiter_session_artist ADD CONSTRAINT FK_D2BB4E6CD17E09A FOREIGN KEY (orbiter_session_id) REFERENCES orbiter_session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orbiter_session_artist ADD CONSTRAINT FK_D2BB4E6CB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orbiter_session_tag ADD CONSTRAINT FK_788AB2AAD17E09A FOREIGN KEY (orbiter_session_id) REFERENCES orbiter_session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orbiter_session_tag ADD CONSTRAINT FK_788AB2AABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orbiter_session_artist DROP FOREIGN KEY FK_D2BB4E6CD17E09A');
        $this->addSql('ALTER TABLE orbiter_session_artist DROP FOREIGN KEY FK_D2BB4E6CB7970CF8');
        $this->addSql('ALTER TABLE orbiter_session_tag DROP FOREIGN KEY FK_788AB2AAD17E09A');
        $this->addSql('ALTER TABLE orbiter_session_tag DROP FOREIGN KEY FK_788AB2AABAD26311');
        $this->addSql('DROP TABLE orbiter_session');
        $this->addSql('DROP TABLE orbiter_session_artist');
        $this->addSql('DROP TABLE orbiter_session_tag');
    }
}
