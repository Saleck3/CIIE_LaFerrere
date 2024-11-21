<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121010509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE resolucion_user (resolucion_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_95FF2516B0D8667A (resolucion_id), INDEX IDX_95FF2516A76ED395 (user_id), PRIMARY KEY(resolucion_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE resolucion_user ADD CONSTRAINT FK_95FF2516B0D8667A FOREIGN KEY (resolucion_id) REFERENCES resolucion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE resolucion_user ADD CONSTRAINT FK_95FF2516A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE fecha');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fecha (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE resolucion_user DROP FOREIGN KEY FK_95FF2516B0D8667A');
        $this->addSql('ALTER TABLE resolucion_user DROP FOREIGN KEY FK_95FF2516A76ED395');
        $this->addSql('DROP TABLE resolucion_user');
    }
}
