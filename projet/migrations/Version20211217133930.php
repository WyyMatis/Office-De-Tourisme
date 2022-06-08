<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211217133930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conseillers_langue (conseillers_id INT NOT NULL, langue_id INT NOT NULL, INDEX IDX_1B119EBE99DA0202 (conseillers_id), INDEX IDX_1B119EBE2AADBACD (langue_id), PRIMARY KEY(conseillers_id, langue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, langage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conseillers_langue ADD CONSTRAINT FK_1B119EBE99DA0202 FOREIGN KEY (conseillers_id) REFERENCES conseillers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conseillers_langue ADD CONSTRAINT FK_1B119EBE2AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conseillers_langue DROP FOREIGN KEY FK_1B119EBE2AADBACD');
        $this->addSql('DROP TABLE conseillers_langue');
        $this->addSql('DROP TABLE langue');
    }
}
