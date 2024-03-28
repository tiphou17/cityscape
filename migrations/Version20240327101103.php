<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240327101103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_property DROP FOREIGN KEY FK_156D53B51AD5CDBF');
        $this->addSql('CREATE TABLE Test (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, stripe_id INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_784DD132A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Test ADD CONSTRAINT FK_784DD132A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBA76ED395');
        $this->addSql('DROP TABLE location');
        $this->addSql('ALTER TABLE cart_property DROP FOREIGN KEY FK_156D53B51AD5CDBF');
        $this->addSql('ALTER TABLE cart_property ADD CONSTRAINT FK_156D53B51AD5CDBF FOREIGN KEY (cart_id) REFERENCES Test (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_property DROP FOREIGN KEY FK_156D53B51AD5CDBF');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, stripe_id INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5E9E89CBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE Test DROP FOREIGN KEY FK_784DD132A76ED395');
        $this->addSql('DROP TABLE Test');
        $this->addSql('ALTER TABLE cart_property DROP FOREIGN KEY FK_156D53B51AD5CDBF');
        $this->addSql('ALTER TABLE cart_property ADD CONSTRAINT FK_156D53B51AD5CDBF FOREIGN KEY (cart_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
