<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240127155741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE year');
        $this->addSql('ALTER TABLE car ADD models_id INT NOT NULL, ADD gearboxes_id INT DEFAULT NULL, ADD energys_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DD966BF49 FOREIGN KEY (models_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D5FF50284 FOREIGN KEY (gearboxes_id) REFERENCES gearbox (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA2A03CA5 FOREIGN KEY (energys_id) REFERENCES energy (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DD966BF49 ON car (models_id)');
        $this->addSql('CREATE INDEX IDX_773DE69D5FF50284 ON car (gearboxes_id)');
        $this->addSql('CREATE INDEX IDX_773DE69DA2A03CA5 ON car (energys_id)');
        $this->addSql('ALTER TABLE image ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FC3C6F69F ON image (car_id)');
        $this->addSql('ALTER TABLE model ADD brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_D79572D944F5D008 ON model (brand_id)');
        $this->addSql('ALTER TABLE service ADD images_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2D44F05E5 FOREIGN KEY (images_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2D44F05E5 ON service (images_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE year (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DD966BF49');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D5FF50284');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DA2A03CA5');
        $this->addSql('DROP INDEX IDX_773DE69DD966BF49 ON car');
        $this->addSql('DROP INDEX IDX_773DE69D5FF50284 ON car');
        $this->addSql('DROP INDEX IDX_773DE69DA2A03CA5 ON car');
        $this->addSql('ALTER TABLE car DROP models_id, DROP gearboxes_id, DROP energys_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FC3C6F69F');
        $this->addSql('DROP INDEX IDX_C53D045FC3C6F69F ON image');
        $this->addSql('ALTER TABLE image DROP car_id');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('DROP INDEX IDX_D79572D944F5D008 ON model');
        $this->addSql('ALTER TABLE model DROP brand_id');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2D44F05E5');
        $this->addSql('DROP INDEX IDX_E19D9AD2D44F05E5 ON service');
        $this->addSql('ALTER TABLE service DROP images_id');
    }
}
