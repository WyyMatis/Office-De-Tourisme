<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104151933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conseillers_specialite (conseillers_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_F70AD8B099DA0202 (conseillers_id), INDEX IDX_F70AD8B02195E0F0 (specialite_id), PRIMARY KEY(conseillers_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, domaine VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conseillers_specialite ADD CONSTRAINT FK_F70AD8B099DA0202 FOREIGN KEY (conseillers_id) REFERENCES conseillers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conseillers_specialite ADD CONSTRAINT FK_F70AD8B02195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conseillers_specialite DROP FOREIGN KEY FK_F70AD8B02195E0F0');
        $this->addSql('DROP TABLE conseillers_specialite');
        $this->addSql('DROP TABLE specialite');
    }
}
