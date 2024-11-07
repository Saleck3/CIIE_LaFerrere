<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241107033854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO revista (id, name) VALUES(1, 'Provisional')");
        $this->addSql("INSERT INTO revista (id, name) VALUES(2, 'Titular')");
        $this->addSql("INSERT INTO revista (id, name) VALUES(3, 'Suplente')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM revista WHERE id=1");
        $this->addSql("DELETE FROM revista WHERE id=2");
        $this->addSql("DELETE FROM revista WHERE id=3");
    }
}
