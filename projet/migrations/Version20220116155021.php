<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220116155021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv ADD titre VARCHAR(255) NOT NULL, ADD heure_debut DATETIME NOT NULL, ADD heure_fin DATETIME NOT NULL, ADD description VARCHAR(255) NOT NULL, ADD background_color VARCHAR(7) NOT NULL, ADD border_color VARCHAR(7) NOT NULL, ADD text_color VARCHAR(7) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv DROP titre, DROP heure_debut, DROP heure_fin, DROP description, DROP background_color, DROP border_color, DROP text_color');
    }
}
