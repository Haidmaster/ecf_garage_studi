<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240211202325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE opening_day (id INT AUTO_INCREMENT NOT NULL, opening_hour_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_33A03DF81F9D579 (opening_hour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opening_hour (id INT AUTO_INCREMENT NOT NULL, open_am VARCHAR(50) NOT NULL, close_am VARCHAR(50) NOT NULL, open_pm VARCHAR(50) NOT NULL, close_pm VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE opening_day ADD CONSTRAINT FK_33A03DF81F9D579 FOREIGN KEY (opening_hour_id) REFERENCES opening_hour (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opening_day DROP FOREIGN KEY FK_33A03DF81F9D579');
        $this->addSql('DROP TABLE opening_day');
        $this->addSql('DROP TABLE opening_hour');
    }
}
