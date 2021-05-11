<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510195319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE frequency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dose ADD frequency_id INT DEFAULT NULL, ADD moment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dose ADD CONSTRAINT FK_EF418CB794879022 FOREIGN KEY (frequency_id) REFERENCES frequency (id)');
        $this->addSql('ALTER TABLE dose ADD CONSTRAINT FK_EF418CB7ABE99143 FOREIGN KEY (moment_id) REFERENCES moment (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF418CB794879022 ON dose (frequency_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF418CB7ABE99143 ON dose (moment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dose DROP FOREIGN KEY FK_EF418CB794879022');
        $this->addSql('ALTER TABLE dose DROP FOREIGN KEY FK_EF418CB7ABE99143');
        $this->addSql('DROP TABLE frequency');
        $this->addSql('DROP TABLE moment');
        $this->addSql('DROP INDEX UNIQ_EF418CB794879022 ON dose');
        $this->addSql('DROP INDEX UNIQ_EF418CB7ABE99143 ON dose');
        $this->addSql('ALTER TABLE dose DROP frequency_id, DROP moment_id');
    }
}
