<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210513014208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dose (id INT AUTO_INCREMENT NOT NULL, frequency_id INT DEFAULT NULL, moment_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_EF418CB794879022 (frequency_id), UNIQUE INDEX UNIQ_EF418CB7ABE99143 (moment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dose ADD CONSTRAINT FK_EF418CB794879022 FOREIGN KEY (frequency_id) REFERENCES frequency (id)');
        $this->addSql('ALTER TABLE dose ADD CONSTRAINT FK_EF418CB7ABE99143 FOREIGN KEY (moment_id) REFERENCES moment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE line DROP FOREIGN KEY FK_D114B4F630BD8B0B');
        $this->addSql('DROP TABLE dose');
    }
}
