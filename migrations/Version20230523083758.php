<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523083758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE capacitebatterie (id INT AUTO_INCREMENT NOT NULL, capacite_batterie VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, velocategorie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motorisation (id INT AUTO_INCREMENT NOT NULL, taille_motor VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nombredevitesse (id INT AUTO_INCREMENT NOT NULL, nombre_vitesse INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE positiondebatterie (id INT AUTO_INCREMENT NOT NULL, position_batterie VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taillederoue (id INT AUTO_INCREMENT NOT NULL, taille_roue VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE velos (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, roues_id INT DEFAULT NULL, capacitebatterie_id INT DEFAULT NULL, motor_id INT DEFAULT NULL, vitesse_id INT DEFAULT NULL, positiondebatterie_id INT DEFAULT NULL, model VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D6EC80E9BCF5E72D (categorie_id), INDEX IDX_D6EC80E91C1E0297 (roues_id), INDEX IDX_D6EC80E97FD4A774 (capacitebatterie_id), INDEX IDX_D6EC80E980D58D71 (motor_id), INDEX IDX_D6EC80E9BFB5A81D (vitesse_id), INDEX IDX_D6EC80E9FB9D911 (positiondebatterie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE velos ADD CONSTRAINT FK_D6EC80E9BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE velos ADD CONSTRAINT FK_D6EC80E91C1E0297 FOREIGN KEY (roues_id) REFERENCES taillederoue (id)');
        $this->addSql('ALTER TABLE velos ADD CONSTRAINT FK_D6EC80E97FD4A774 FOREIGN KEY (capacitebatterie_id) REFERENCES capacitebatterie (id)');
        $this->addSql('ALTER TABLE velos ADD CONSTRAINT FK_D6EC80E980D58D71 FOREIGN KEY (motor_id) REFERENCES motorisation (id)');
        $this->addSql('ALTER TABLE velos ADD CONSTRAINT FK_D6EC80E9BFB5A81D FOREIGN KEY (vitesse_id) REFERENCES nombredevitesse (id)');
        $this->addSql('ALTER TABLE velos ADD CONSTRAINT FK_D6EC80E9FB9D911 FOREIGN KEY (positiondebatterie_id) REFERENCES positiondebatterie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE velos DROP FOREIGN KEY FK_D6EC80E9BCF5E72D');
        $this->addSql('ALTER TABLE velos DROP FOREIGN KEY FK_D6EC80E91C1E0297');
        $this->addSql('ALTER TABLE velos DROP FOREIGN KEY FK_D6EC80E97FD4A774');
        $this->addSql('ALTER TABLE velos DROP FOREIGN KEY FK_D6EC80E980D58D71');
        $this->addSql('ALTER TABLE velos DROP FOREIGN KEY FK_D6EC80E9BFB5A81D');
        $this->addSql('ALTER TABLE velos DROP FOREIGN KEY FK_D6EC80E9FB9D911');
        $this->addSql('DROP TABLE capacitebatterie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE motorisation');
        $this->addSql('DROP TABLE nombredevitesse');
        $this->addSql('DROP TABLE positiondebatterie');
        $this->addSql('DROP TABLE taillederoue');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE velos');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
