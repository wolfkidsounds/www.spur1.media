<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206090216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_crew (post_id INT NOT NULL, crew_id INT NOT NULL, INDEX IDX_401C27B94B89032C (post_id), INDEX IDX_401C27B95FE259F6 (crew_id), PRIMARY KEY(post_id, crew_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_crew ADD CONSTRAINT FK_401C27B94B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_crew ADD CONSTRAINT FK_401C27B95FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crew_post DROP FOREIGN KEY FK_63B68A924B89032C');
        $this->addSql('ALTER TABLE crew_post DROP FOREIGN KEY FK_63B68A925FE259F6');
        $this->addSql('DROP TABLE crew_post');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE crew_post (crew_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_63B68A925FE259F6 (crew_id), INDEX IDX_63B68A924B89032C (post_id), PRIMARY KEY(crew_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE crew_post ADD CONSTRAINT FK_63B68A924B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crew_post ADD CONSTRAINT FK_63B68A925FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_crew DROP FOREIGN KEY FK_401C27B94B89032C');
        $this->addSql('ALTER TABLE post_crew DROP FOREIGN KEY FK_401C27B95FE259F6');
        $this->addSql('DROP TABLE post_crew');
    }
}
