<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190428180125 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE changes_site_changes DROP FOREIGN KEY changes_site_changes_ibfk_1');
        $this->addSql('ALTER TABLE changes_site_changes DROP FOREIGN KEY changes_site_changes_ibfk_2');
        $this->addSql('ALTER TABLE site_changes DROP FOREIGN KEY site_changes_ibfk_1');
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(20) NOT NULL, pass VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE accounts');
        $this->addSql('DROP TABLE changes');
        $this->addSql('DROP TABLE changes_site_changes');
        $this->addSql('DROP TABLE site_changes');
        $this->addSql('DROP TABLE sites');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE accounts (login VARCHAR(20) NOT NULL COLLATE latin1_swedish_ci, pass TEXT NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(login)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE changes (change_id INT AUTO_INCREMENT NOT NULL, name TEXT NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(change_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE changes_site_changes (change_id INT NOT NULL, site_changes_id INT NOT NULL, INDEX site_changes_id (site_changes_id), INDEX change_id (change_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE site_changes (site_changes_id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, changeDate DATE NOT NULL, INDEX site_id (site_id), PRIMARY KEY(site_changes_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sites (site_id INT AUTO_INCREMENT NOT NULL, url TEXT NOT NULL COLLATE latin1_swedish_ci, name TEXT NOT NULL COLLATE latin1_swedish_ci, mail TEXT DEFAULT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(site_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE changes_site_changes ADD CONSTRAINT changes_site_changes_ibfk_1 FOREIGN KEY (change_id) REFERENCES changes (change_id)');
        $this->addSql('ALTER TABLE changes_site_changes ADD CONSTRAINT changes_site_changes_ibfk_2 FOREIGN KEY (site_changes_id) REFERENCES site_changes (site_changes_id)');
        $this->addSql('ALTER TABLE site_changes ADD CONSTRAINT site_changes_ibfk_1 FOREIGN KEY (site_id) REFERENCES sites (site_id)');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE product');
    }
}
