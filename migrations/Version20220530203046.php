<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220530203046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (license_plate VARCHAR(255) NOT NULL, client_number_id INT DEFAULT NULL, parking_number_id INT NOT NULL, mark VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, number_of_seats SMALLINT NOT NULL, fuel VARCHAR(255) NOT NULL, INDEX IDX_773DE69DDB810E1F (client_number_id), INDEX IDX_773DE69DF8100741 (parking_number_id), PRIMARY KEY(license_plate)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parking (id INT AUTO_INCREMENT NOT NULL, capacity INT NOT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DDB810E1F FOREIGN KEY (client_number_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DF8100741 FOREIGN KEY (parking_number_id) REFERENCES parking (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DF8100741');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE parking');
    }
}
