<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240127175124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D5FF50284');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DA2A03CA5');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D40C1FEA7');
        $this->addSql('DROP TABLE gearbox');
        $this->addSql('DROP TABLE energy');
        $this->addSql('DROP TABLE year');
        $this->addSql('DROP INDEX IDX_773DE69D5FF50284 ON car');
        $this->addSql('DROP INDEX IDX_773DE69DA2A03CA5 ON car');
        $this->addSql('DROP INDEX IDX_773DE69D40C1FEA7 ON car');
        $this->addSql('ALTER TABLE car ADD years INT NOT NULL, ADD gearbox VARCHAR(32) NOT NULL, ADD energy VARCHAR(32) NOT NULL, DROP gearboxes_id, DROP energys_id, DROP year_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FC3C6F69F');
        $this->addSql('DROP INDEX IDX_C53D045FC3C6F69F ON image');
        $this->addSql('ALTER TABLE image DROP car_id');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2D44F05E5');
        $this->addSql('DROP INDEX IDX_E19D9AD2D44F05E5 ON service');
        $this->addSql('ALTER TABLE service DROP images_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gearbox (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE energy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(16) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE year (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE car ADD gearboxes_id INT DEFAULT NULL, ADD energys_id INT DEFAULT NULL, ADD year_id INT DEFAULT NULL, DROP years, DROP gearbox, DROP energy');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D40C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D5FF50284 FOREIGN KEY (gearboxes_id) REFERENCES gearbox (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA2A03CA5 FOREIGN KEY (energys_id) REFERENCES energy (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_773DE69D5FF50284 ON car (gearboxes_id)');
        $this->addSql('CREATE INDEX IDX_773DE69DA2A03CA5 ON car (energys_id)');
        $this->addSql('CREATE INDEX IDX_773DE69D40C1FEA7 ON car (year_id)');
        $this->addSql('ALTER TABLE image ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C53D045FC3C6F69F ON image (car_id)');
        $this->addSql('ALTER TABLE service ADD images_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2D44F05E5 FOREIGN KEY (images_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E19D9AD2D44F05E5 ON service (images_id)');
    }
}
