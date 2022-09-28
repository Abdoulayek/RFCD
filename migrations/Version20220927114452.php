<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927114452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
      //$this->addSql('CREATE TABLE certificateurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, experiences VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
      // $this->addSql('CREATE TABLE certificateurs_user (certificateurs_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_40ACFD1D2A2AA117 (certificateurs_id), INDEX IDX_40ACFD1DA76ED395 (user_id), PRIMARY KEY(certificateurs_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
      //  $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, relation_certif_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, certificateur_choisi VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4C62E638265A0880 (relation_certif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
   // $this->addSql('CREATE TABLE stagiaires (id INT AUTO_INCREMENT NOT NULL, relationuser_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, profil VARCHAR(255) NOT NULL, INDEX IDX_4A9FADC649793480 (relationuser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
      //  $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, siret INT NOT NULL, nbre_stagiaires INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    //   $this->addSql('CREATE TABLE usr (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    //   $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    //$this->addSql('ALTER TABLE certificateurs_user ADD CONSTRAINT FK_40ACFD1D2A2AA117 FOREIGN KEY (certificateurs_id) REFERENCES certificateurs (id) ON DELETE CASCADE');
    //$this->addSql('ALTER TABLE certificateurs_user ADD CONSTRAINT FK_40ACFD1DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
   $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638265A0880 FOREIGN KEY (relation_certif_id) REFERENCES certificateurs (id)');
 $this->addSql('ALTER TABLE stagiaires ADD CONSTRAINT FK_4A9FADC649793480 FOREIGN KEY (relationuser_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificateurs_user DROP FOREIGN KEY FK_40ACFD1D2A2AA117');
      //  $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638265A0880');
        $this->addSql('ALTER TABLE certificateurs_user DROP FOREIGN KEY FK_40ACFD1DA76ED395');
       // $this->addSql('ALTER TABLE stagiaires DROP FOREIGN KEY FK_4A9FADC649793480');
        $this->addSql('DROP TABLE certificateurs');
        $this->addSql('DROP TABLE certificateurs_user');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE stagiaires');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE usr');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
