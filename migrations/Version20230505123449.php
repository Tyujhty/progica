<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505123449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shelter (id INT AUTO_INCREMENT NOT NULL, price_id INT NOT NULL, manager_id INT NOT NULL, owner_id INT NOT NULL, town_id INT NOT NULL, name VARCHAR(255) NOT NULL, surface DOUBLE PRECISION NOT NULL, nb_bedrooms INT NOT NULL, nb_beds INT NOT NULL, accept_animals TINYINT(1) NOT NULL, price_animals NUMERIC(7, 2) NOT NULL, INDEX IDX_71106707D614C7E7 (price_id), INDEX IDX_71106707783E3463 (manager_id), INDEX IDX_711067077E3C61F9 (owner_id), INDEX IDX_7110670775E23604 (town_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shelter ADD CONSTRAINT FK_71106707D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id)');
        $this->addSql('ALTER TABLE shelter ADD CONSTRAINT FK_71106707783E3463 FOREIGN KEY (manager_id) REFERENCES manager (id)');
        $this->addSql('ALTER TABLE shelter ADD CONSTRAINT FK_711067077E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
        $this->addSql('ALTER TABLE shelter ADD CONSTRAINT FK_7110670775E23604 FOREIGN KEY (town_id) REFERENCES town (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shelter DROP FOREIGN KEY FK_71106707D614C7E7');
        $this->addSql('ALTER TABLE shelter DROP FOREIGN KEY FK_71106707783E3463');
        $this->addSql('ALTER TABLE shelter DROP FOREIGN KEY FK_711067077E3C61F9');
        $this->addSql('ALTER TABLE shelter DROP FOREIGN KEY FK_7110670775E23604');
        $this->addSql('DROP TABLE shelter');
    }
}
