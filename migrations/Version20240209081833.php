<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209081833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `rakhassalma_commentaires` (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, commentaire LONGTEXT NOT NULL, note_lavage INT DEFAULT NULL, note_station INT DEFAULT NULL, INDEX IDX_3EB0030919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `rakhassalma_commentaires` ADD CONSTRAINT FK_3EB0030919EB6921 FOREIGN KEY (client_id) REFERENCES `rakhassalma_clients` (id)');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC19EB6921');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('ALTER TABLE rakhassalma_users ADD avatar VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE rakhassalma_voitures ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rakhassalma_voitures ADD CONSTRAINT FK_3791C25819EB6921 FOREIGN KEY (client_id) REFERENCES `rakhassalma_clients` (id)');
        $this->addSql('CREATE INDEX IDX_3791C25819EB6921 ON rakhassalma_voitures (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, commentaire LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, note_lavage INT DEFAULT NULL, note_station INT DEFAULT NULL, INDEX IDX_67F068BC19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC19EB6921 FOREIGN KEY (client_id) REFERENCES rakhassalma_clients (id)');
        $this->addSql('ALTER TABLE `rakhassalma_commentaires` DROP FOREIGN KEY FK_3EB0030919EB6921');
        $this->addSql('DROP TABLE `rakhassalma_commentaires`');
        $this->addSql('ALTER TABLE `rakhassalma_users` DROP avatar');
        $this->addSql('ALTER TABLE `rakhassalma_voitures` DROP FOREIGN KEY FK_3791C25819EB6921');
        $this->addSql('DROP INDEX IDX_3791C25819EB6921 ON `rakhassalma_voitures`');
        $this->addSql('ALTER TABLE `rakhassalma_voitures` DROP client_id');
    }
}
