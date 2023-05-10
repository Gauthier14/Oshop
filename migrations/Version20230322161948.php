<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322161948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product CHANGE brand_id brand_id INT UNSIGNED DEFAULT NULL, CHANGE type_id type_id INT UNSIGNED DEFAULT NULL, CHANGE price price NUMERIC(10, 2) NOT NULL COMMENT \'Le prix du produit\', CHANGE rate rate NUMERIC(10, 0) NOT NULL COMMENT \'L\'\'avis sur le produit, de 1 à 5\', CHANGE status status INT NOT NULL COMMENT \'Le statut du produit (1=dispo, 2=pas dispo)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE product CHANGE type_id type_id INT UNSIGNED NOT NULL, CHANGE brand_id brand_id INT UNSIGNED NOT NULL, CHANGE price price NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL COMMENT \'Le prix du produit\', CHANGE rate rate TINYINT(1) NOT NULL COMMENT \'L\'\'avis sur le produit, de 1 à 5\', CHANGE status status TINYINT(1) NOT NULL COMMENT \'Le statut du produit (1=dispo, 2=pas dispo)\'');
    }
}
