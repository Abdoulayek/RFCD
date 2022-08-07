<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220807161609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64923988DFE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BD57FAB3');
        $this->addSql('DROP INDEX IDX_8D93D64923988DFE ON user');
        $this->addSql('DROP INDEX IDX_8D93D649BD57FAB3 ON user');
        $this->addSql('ALTER TABLE user DROP stagiairesss_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD stagiairesss_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64923988DFE FOREIGN KEY (stagiairesss_id) REFERENCES stagiaires (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BD57FAB3 FOREIGN KEY (stagiairesss_id) REFERENCES stagiaires (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D64923988DFE ON user (stagiairesss_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649BD57FAB3 ON user (stagiairesss_id)');
    }
}
