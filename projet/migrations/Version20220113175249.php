<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220113175249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE creneau (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creneau_conseillers (creneau_id INT NOT NULL, conseillers_id INT NOT NULL, INDEX IDX_D743CBDD7D0729A9 (creneau_id), INDEX IDX_D743CBDD99DA0202 (conseillers_id), PRIMARY KEY(creneau_id, conseillers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rdv (id INT AUTO_INCREMENT NOT NULL, creneau_id INT DEFAULT NULL, conseillers_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_10C31F867D0729A9 (creneau_id), INDEX IDX_10C31F8699DA0202 (conseillers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE creneau_conseillers ADD CONSTRAINT FK_D743CBDD7D0729A9 FOREIGN KEY (creneau_id) REFERENCES creneau (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE creneau_conseillers ADD CONSTRAINT FK_D743CBDD99DA0202 FOREIGN KEY (conseillers_id) REFERENCES conseillers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F867D0729A9 FOREIGN KEY (creneau_id) REFERENCES creneau (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F8699DA0202 FOREIGN KEY (conseillers_id) REFERENCES conseillers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE creneau_conseillers DROP FOREIGN KEY FK_D743CBDD7D0729A9');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F867D0729A9');
        $this->addSql('DROP TABLE creneau');
        $this->addSql('DROP TABLE creneau_conseillers');
        $this->addSql('DROP TABLE rdv');
    }
}
