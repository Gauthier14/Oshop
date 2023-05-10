<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321131725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE home_order home_order TINYINT(1) NOT NULL COMMENT \'L\'\'ordre d\'\'affichage de la catégorie sur la home (0=pas affichée en home)\'');
        $this->addSql('ALTER TABLE product CHANGE rate rate TINYINT(1) NOT NULL COMMENT \'L\'\'avis sur le produit, de 1 à 5\', CHANGE status status TINYINT(1) NOT NULL COMMENT \'Le statut du produit (1=dispo, 2=pas dispo)\'');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC54C8C93');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD44F5D008');
        $this->addSql('ALTER TABLE product CHANGE rate rate TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'L\'\'avis sur le produit, de 1 à 5\', CHANGE status status TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'Le statut du produit (1=dispo, 2=pas dispo)\'');
        $this->addSql('ALTER TABLE category CHANGE home_order home_order TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'L\'\'ordre d\'\'affichage de la catégorie sur la home (0=pas affichée en home)\'');
    }
}
