<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241108002802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resolucion ADD docente_id INT NOT NULL');
        $this->addSql('ALTER TABLE resolucion ADD CONSTRAINT FK_301D60AC94E27525 FOREIGN KEY (docente_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_301D60AC94E27525 ON resolucion (docente_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resolucion DROP FOREIGN KEY FK_301D60AC94E27525');
        $this->addSql('DROP INDEX IDX_301D60AC94E27525 ON resolucion');
        $this->addSql('ALTER TABLE resolucion DROP docente_id');
    }
}
