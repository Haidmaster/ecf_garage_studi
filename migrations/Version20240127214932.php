<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240127214932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DD966BF49');
        $this->addSql('DROP INDEX IDX_773DE69DD966BF49 ON car');
        $this->addSql('ALTER TABLE car DROP models_id');
        $this->addSql('ALTER TABLE model ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_D79572D9C3C6F69F ON model (car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car ADD models_id INT NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DD966BF49 FOREIGN KEY (models_id) REFERENCES model (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_773DE69DD966BF49 ON car (models_id)');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9C3C6F69F');
        $this->addSql('DROP INDEX IDX_D79572D9C3C6F69F ON model');
        $this->addSql('ALTER TABLE model DROP car_id');
    }
}
