<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220530192537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contrat (contrat_number INT AUTO_INCREMENT NOT NULL, client_number_id INT DEFAULT NULL, license_plate VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date_of_departure DATETIME NOT NULL, date_of_return DATETIME NOT NULL, INDEX IDX_60349993DB810E1F (client_number_id), PRIMARY KEY(contrat_number)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993DB810E1F FOREIGN KEY (client_number_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contrat');
    }
}
