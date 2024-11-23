<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241123211041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_encuentro (user_id INT NOT NULL, encuentro_id INT NOT NULL, INDEX IDX_CD1AFA1EA76ED395 (user_id), INDEX IDX_CD1AFA1EE304C7C8 (encuentro_id), PRIMARY KEY(user_id, encuentro_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_encuentro ADD CONSTRAINT FK_CD1AFA1EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_encuentro ADD CONSTRAINT FK_CD1AFA1EE304C7C8 FOREIGN KEY (encuentro_id) REFERENCES encuentro (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_encuentro DROP FOREIGN KEY FK_CD1AFA1EA76ED395');
        $this->addSql('ALTER TABLE user_encuentro DROP FOREIGN KEY FK_CD1AFA1EE304C7C8');
        $this->addSql('DROP TABLE user_encuentro');
    }
}
