<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220807160634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stagiaires ADD relationuser_id INT NOT NULL');
        $this->addSql('ALTER TABLE stagiaires ADD CONSTRAINT FK_4A9FADC649793480 FOREIGN KEY (relationuser_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4A9FADC649793480 ON stagiaires (relationuser_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649887A63F9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E7A1254A');
        $this->addSql('DROP INDEX IDX_8D93D649887A63F9 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649E7A1254A ON user');
        $this->addSql('ALTER TABLE user DROP stagiaires_id, DROP contact_id, CHANGE stagiairess_id stagiairesss_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BD57FAB3 FOREIGN KEY (stagiairesss_id) REFERENCES stagiaires (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649BD57FAB3 ON user (stagiairesss_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stagiaires DROP FOREIGN KEY FK_4A9FADC649793480');
        $this->addSql('DROP INDEX IDX_4A9FADC649793480 ON stagiaires');
        $this->addSql('ALTER TABLE stagiaires DROP relationuser_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BD57FAB3');
        $this->addSql('DROP INDEX IDX_8D93D649BD57FAB3 ON user');
        $this->addSql('ALTER TABLE user ADD stagiaires_id INT DEFAULT NULL, ADD contact_id INT DEFAULT NULL, CHANGE stagiairesss_id stagiairess_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649887A63F9 FOREIGN KEY (stagiaires_id) REFERENCES stagiaires (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D649887A63F9 ON user (stagiaires_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E7A1254A ON user (contact_id)');
    }
}
