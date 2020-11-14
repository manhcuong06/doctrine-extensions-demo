<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201113043580 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Table tree';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tree (id INT AUTO_INCREMENT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, title VARCHAR(64) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, INDEX IDX_B73E5EDCA977936C (tree_root), INDEX IDX_B73E5EDC727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tree ADD CONSTRAINT FK_B73E5EDCA977936C FOREIGN KEY (tree_root) REFERENCES tree (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tree ADD CONSTRAINT FK_B73E5EDC727ACA70 FOREIGN KEY (parent_id) REFERENCES tree (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tree DROP FOREIGN KEY FK_B73E5EDCA977936C');
        $this->addSql('ALTER TABLE tree DROP FOREIGN KEY FK_B73E5EDC727ACA70');
        $this->addSql('DROP TABLE tree');
    }
}
