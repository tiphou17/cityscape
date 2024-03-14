<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313140413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81D4948FC3');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81EC874D1F');
        $this->addSql('DROP INDEX UNIQ_D4E6F81EC874D1F ON address');
        $this->addSql('DROP INDEX IDX_D4E6F81D4948FC3 ON address');
        $this->addSql('ALTER TABLE address DROP add_prop_id, DROP add_country_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address ADD add_prop_id INT NOT NULL, ADD add_country_id INT NOT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81D4948FC3 FOREIGN KEY (add_country_id) REFERENCES country (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81EC874D1F FOREIGN KEY (add_prop_id) REFERENCES property (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4E6F81EC874D1F ON address (add_prop_id)');
        $this->addSql('CREATE INDEX IDX_D4E6F81D4948FC3 ON address (add_country_id)');
    }
}
