<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523151008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shelter ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE shelter ADD CONSTRAINT FK_71106707A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_71106707A76ED395 ON shelter (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shelter DROP FOREIGN KEY FK_71106707A76ED395');
        $this->addSql('DROP INDEX IDX_71106707A76ED395 ON shelter');
        $this->addSql('ALTER TABLE shelter DROP user_id');
    }
}
