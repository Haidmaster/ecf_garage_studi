<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240211211617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opening_day DROP FOREIGN KEY FK_33A03DF81F9D579');
        $this->addSql('DROP INDEX IDX_33A03DF81F9D579 ON opening_day');
        $this->addSql('ALTER TABLE opening_day ADD opening_hours_id INT DEFAULT NULL, DROP opening_hour_id');
        $this->addSql('ALTER TABLE opening_day ADD CONSTRAINT FK_33A03DFCE298D68 FOREIGN KEY (opening_hours_id) REFERENCES opening_hour (id)');
        $this->addSql('CREATE INDEX IDX_33A03DFCE298D68 ON opening_day (opening_hours_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opening_day DROP FOREIGN KEY FK_33A03DFCE298D68');
        $this->addSql('DROP INDEX IDX_33A03DFCE298D68 ON opening_day');
        $this->addSql('ALTER TABLE opening_day ADD opening_hour_id INT NOT NULL, DROP opening_hours_id');
        $this->addSql('ALTER TABLE opening_day ADD CONSTRAINT FK_33A03DF81F9D579 FOREIGN KEY (opening_hour_id) REFERENCES opening_hour (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_33A03DF81F9D579 ON opening_day (opening_hour_id)');
    }
}
