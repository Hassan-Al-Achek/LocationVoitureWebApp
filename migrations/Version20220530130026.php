<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220530130026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoice (invoice_number INT AUTO_INCREMENT NOT NULL, client_number_id INT DEFAULT NULL, invoice_date DATETIME NOT NULL, km_counter INT NOT NULL, pt_amount DOUBLE PRECISION NOT NULL, ammount_to_pay DOUBLE PRECISION NOT NULL, INDEX IDX_90651744DB810E1F (client_number_id), PRIMARY KEY(invoice_number)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744DB810E1F FOREIGN KEY (client_number_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE invoice');
    }
}
