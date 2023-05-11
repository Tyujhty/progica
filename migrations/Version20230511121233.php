<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511121233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exterior_equipment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exterior_equipment_shelter (exterior_equipment_id INT NOT NULL, shelter_id INT NOT NULL, INDEX IDX_EB51A5ED22D543C0 (exterior_equipment_id), INDEX IDX_EB51A5ED54053EC0 (shelter_id), PRIMARY KEY(exterior_equipment_id, shelter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exterior_equipment_shelter ADD CONSTRAINT FK_EB51A5ED22D543C0 FOREIGN KEY (exterior_equipment_id) REFERENCES exterior_equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exterior_equipment_shelter ADD CONSTRAINT FK_EB51A5ED54053EC0 FOREIGN KEY (shelter_id) REFERENCES shelter (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exterior_equipment_shelter DROP FOREIGN KEY FK_EB51A5ED22D543C0');
        $this->addSql('ALTER TABLE exterior_equipment_shelter DROP FOREIGN KEY FK_EB51A5ED54053EC0');
        $this->addSql('DROP TABLE exterior_equipment');
        $this->addSql('DROP TABLE exterior_equipment_shelter');
    }
}
