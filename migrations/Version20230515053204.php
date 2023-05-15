<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515053204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exterior_equipment_shelter ADD CONSTRAINT FK_EB51A5ED22D543C0 FOREIGN KEY (exterior_equipment_id) REFERENCES exterior_equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE interior_equipment_shelter ADD CONSTRAINT FK_A7205547713B78FD FOREIGN KEY (interior_equipment_id) REFERENCES interior_equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_shelter ADD CONSTRAINT FK_BE94359BED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shelter ADD description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exterior_equipment_shelter DROP FOREIGN KEY FK_EB51A5ED22D543C0');
        $this->addSql('ALTER TABLE interior_equipment_shelter DROP FOREIGN KEY FK_A7205547713B78FD');
        $this->addSql('ALTER TABLE service_shelter DROP FOREIGN KEY FK_BE94359BED5CA9E6');
        $this->addSql('ALTER TABLE shelter DROP description');
    }
}
