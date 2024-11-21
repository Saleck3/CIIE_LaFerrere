<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121002647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE encuentro (id INT AUTO_INCREMENT NOT NULL, resolucion_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_CDFA77FAB0D8667A (resolucion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fecha (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE encuentro ADD CONSTRAINT FK_CDFA77FAB0D8667A FOREIGN KEY (resolucion_id) REFERENCES resolucion (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encuentro DROP FOREIGN KEY FK_CDFA77FAB0D8667A');
        $this->addSql('DROP TABLE encuentro');
        $this->addSql('DROP TABLE fecha');
    }
}
