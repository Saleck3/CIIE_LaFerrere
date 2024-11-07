<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241107030447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE curso (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, clave VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resolucion (id INT AUTO_INCREMENT NOT NULL, curso_id INT NOT NULL, cohorte_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_301D60AC87CB4A1F (curso_id), INDEX IDX_301D60ACFB30EFA4 (cohorte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE resolucion ADD CONSTRAINT FK_301D60AC87CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id)');
        $this->addSql('ALTER TABLE resolucion ADD CONSTRAINT FK_301D60ACFB30EFA4 FOREIGN KEY (cohorte_id) REFERENCES cohorte (id)');
        $this->addSql('ALTER TABLE cohorte ADD start_date DATE NOT NULL, ADD end_date DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resolucion DROP FOREIGN KEY FK_301D60AC87CB4A1F');
        $this->addSql('ALTER TABLE resolucion DROP FOREIGN KEY FK_301D60ACFB30EFA4');
        $this->addSql('DROP TABLE curso');
        $this->addSql('DROP TABLE resolucion');
        $this->addSql('ALTER TABLE cohorte DROP start_date, DROP end_date');
    }
}
