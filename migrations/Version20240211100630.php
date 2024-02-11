<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240211100630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP you_tube_url, DROP soundcloud_url, DROP facebook_url, DROP instagram_url, DROP spotify_url, DROP mixcloud_url, DROP bandcamp_url');
        $this->addSql('ALTER TABLE crew DROP you_tube_url, DROP soundcloud_url, DROP facebook_url, DROP instagram_url, DROP linktree_url');
        $this->addSql('ALTER TABLE link ADD artist_id INT NOT NULL, ADD crew_id INT NOT NULL');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F15FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id)');
        $this->addSql('CREATE INDEX IDX_36AC99F1B7970CF8 ON link (artist_id)');
        $this->addSql('CREATE INDEX IDX_36AC99F15FE259F6 ON link (crew_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist ADD you_tube_url VARCHAR(255) DEFAULT NULL, ADD soundcloud_url VARCHAR(255) DEFAULT NULL, ADD facebook_url VARCHAR(255) DEFAULT NULL, ADD instagram_url VARCHAR(255) DEFAULT NULL, ADD spotify_url VARCHAR(255) DEFAULT NULL, ADD mixcloud_url VARCHAR(255) DEFAULT NULL, ADD bandcamp_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE crew ADD you_tube_url VARCHAR(255) DEFAULT NULL, ADD soundcloud_url VARCHAR(255) DEFAULT NULL, ADD facebook_url VARCHAR(255) DEFAULT NULL, ADD instagram_url VARCHAR(255) DEFAULT NULL, ADD linktree_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F1B7970CF8');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F15FE259F6');
        $this->addSql('DROP INDEX IDX_36AC99F1B7970CF8 ON link');
        $this->addSql('DROP INDEX IDX_36AC99F15FE259F6 ON link');
        $this->addSql('ALTER TABLE link DROP artist_id, DROP crew_id');
    }
}
