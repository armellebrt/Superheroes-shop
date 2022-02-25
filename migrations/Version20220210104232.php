<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210104232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories RENAME INDEX fk_3af346683d8e604f TO parent');
        $this->addSql('ALTER TABLE users ADD roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories CHANGE identifier identifier VARCHAR(32) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE label label VARCHAR(32) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE path path VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE categories RENAME INDEX parent TO FK_3AF346683D8E604F');
        $this->addSql('ALTER TABLE products CHANGE sku sku VARCHAR(32) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE name name TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE image image TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE users DROP roles, CHANGE pseudo pseudo VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE email email VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE password_hash password_hash VARCHAR(150) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }
}
