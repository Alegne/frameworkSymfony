<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191023221642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nrh_categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nrh_client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_52E430406C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nrh_commande (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date_commande DATETIME NOT NULL, INDEX IDX_78EB217C19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nrh_ligne_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, produit_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_59FDB0CB82EA2E54 (commande_id), INDEX IDX_59FDB0CBF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nrh_produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, stock INT NOT NULL, prix_unitaire INT NOT NULL, INDEX IDX_44EDA8F8BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nrh_commande ADD CONSTRAINT FK_78EB217C19EB6921 FOREIGN KEY (client_id) REFERENCES nrh_client (id)');
        $this->addSql('ALTER TABLE nrh_ligne_commande ADD CONSTRAINT FK_59FDB0CB82EA2E54 FOREIGN KEY (commande_id) REFERENCES nrh_commande (id)');
        $this->addSql('ALTER TABLE nrh_ligne_commande ADD CONSTRAINT FK_59FDB0CBF347EFB FOREIGN KEY (produit_id) REFERENCES nrh_produit (id)');
        $this->addSql('ALTER TABLE nrh_produit ADD CONSTRAINT FK_44EDA8F8BCF5E72D FOREIGN KEY (categorie_id) REFERENCES nrh_categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nrh_produit DROP FOREIGN KEY FK_44EDA8F8BCF5E72D');
        $this->addSql('ALTER TABLE nrh_commande DROP FOREIGN KEY FK_78EB217C19EB6921');
        $this->addSql('ALTER TABLE nrh_ligne_commande DROP FOREIGN KEY FK_59FDB0CB82EA2E54');
        $this->addSql('ALTER TABLE nrh_ligne_commande DROP FOREIGN KEY FK_59FDB0CBF347EFB');
        $this->addSql('DROP TABLE nrh_categorie');
        $this->addSql('DROP TABLE nrh_client');
        $this->addSql('DROP TABLE nrh_commande');
        $this->addSql('DROP TABLE nrh_ligne_commande');
        $this->addSql('DROP TABLE nrh_produit');
    }
}
