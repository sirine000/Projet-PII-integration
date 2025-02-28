<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250216223928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_client_commande_id INT NOT NULL, livraison_id INT NOT NULL, produit VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, adresse LONGTEXT NOT NULL, num_tel INT NOT NULL, UNIQUE INDEX UNIQ_6EEAA67D83B9C0 (id_client_commande_id), INDEX IDX_6EEAA67D8E54FB25 (livraison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enchere (id INT AUTO_INCREMENT NOT NULL, id_gagnant_id INT NOT NULL, id_agriculteur_id INT NOT NULL, id_produit_enchere_id INT NOT NULL, derniere_prix DOUBLE PRECISION NOT NULL, INDEX IDX_38D1870FA773C26F (id_gagnant_id), INDEX IDX_38D1870F43DD3C08 (id_agriculteur_id), UNIQUE INDEX UNIQ_38D1870FC211E559 (id_produit_enchere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, offre DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, id_transporteur_id INT NOT NULL, is_etat TINYINT(1) NOT NULL, INDEX IDX_A60C9F1F7E96AC2C (id_transporteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, id_client_id INT NOT NULL, UNIQUE INDEX UNIQ_24CC0DF299DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier_produit_store (panier_id INT NOT NULL, produit_store_id INT NOT NULL, INDEX IDX_CC2EEE7DF77D927C (panier_id), INDEX IDX_CC2EEE7D998D9A02 (produit_store_id), PRIMARY KEY(panier_id, produit_store_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_enchere (id INT AUTO_INCREMENT NOT NULL, agriculteur_id_id INT NOT NULL, categorie_id_id INT NOT NULL, nom VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, quantie INT NOT NULL, path_img VARCHAR(255) NOT NULL, INDEX IDX_FE2A0C7612F42B4A (agriculteur_id_id), INDEX IDX_FE2A0C768A3C7387 (categorie_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_store (id INT AUTO_INCREMENT NOT NULL, agriculteur_id_id INT NOT NULL, categorie_id_id INT NOT NULL, nom VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, quantite DOUBLE PRECISION NOT NULL, prix DOUBLE PRECISION NOT NULL, path_img VARCHAR(255) NOT NULL, INDEX IDX_CFCB3FE312F42B4A (agriculteur_id_id), INDEX IDX_CFCB3FE38A3C7387 (categorie_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, description LONGTEXT NOT NULL, is_etat TINYINT(1) NOT NULL, INDEX IDX_CE60640479F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_5FB6DEC79D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transporteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(255) NOT NULL, is_disponible TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone_number BIGINT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D83B9C0 FOREIGN KEY (id_client_commande_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870FA773C26F FOREIGN KEY (id_gagnant_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870F43DD3C08 FOREIGN KEY (id_agriculteur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870FC211E559 FOREIGN KEY (id_produit_enchere_id) REFERENCES produit_enchere (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F7E96AC2C FOREIGN KEY (id_transporteur_id) REFERENCES transporteur (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF299DED506 FOREIGN KEY (id_client_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE panier_produit_store ADD CONSTRAINT FK_CC2EEE7DF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_produit_store ADD CONSTRAINT FK_CC2EEE7D998D9A02 FOREIGN KEY (produit_store_id) REFERENCES produit_store (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_enchere ADD CONSTRAINT FK_FE2A0C7612F42B4A FOREIGN KEY (agriculteur_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE produit_enchere ADD CONSTRAINT FK_FE2A0C768A3C7387 FOREIGN KEY (categorie_id_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit_store ADD CONSTRAINT FK_CFCB3FE312F42B4A FOREIGN KEY (agriculteur_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE produit_store ADD CONSTRAINT FK_CFCB3FE38A3C7387 FOREIGN KEY (categorie_id_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640479F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC79D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D83B9C0');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870FA773C26F');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870F43DD3C08');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870FC211E559');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F7E96AC2C');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF299DED506');
        $this->addSql('ALTER TABLE panier_produit_store DROP FOREIGN KEY FK_CC2EEE7DF77D927C');
        $this->addSql('ALTER TABLE panier_produit_store DROP FOREIGN KEY FK_CC2EEE7D998D9A02');
        $this->addSql('ALTER TABLE produit_enchere DROP FOREIGN KEY FK_FE2A0C7612F42B4A');
        $this->addSql('ALTER TABLE produit_enchere DROP FOREIGN KEY FK_FE2A0C768A3C7387');
        $this->addSql('ALTER TABLE produit_store DROP FOREIGN KEY FK_CFCB3FE312F42B4A');
        $this->addSql('ALTER TABLE produit_store DROP FOREIGN KEY FK_CFCB3FE38A3C7387');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640479F37AE5');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC79D86650F');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE panier_produit_store');
        $this->addSql('DROP TABLE produit_enchere');
        $this->addSql('DROP TABLE produit_store');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE transporteur');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
