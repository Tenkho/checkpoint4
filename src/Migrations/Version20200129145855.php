<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129145855 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE performs (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(40) NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `representation` (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, localisation VARCHAR(255) NOT NULL, max_place INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE show_performs (show_id INT NOT NULL, performs_id INT NOT NULL, INDEX IDX_546F8C74D0C1FC64 (show_id), INDEX IDX_546F8C74D0865E2E (performs_id), PRIMARY KEY(show_id, performs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, spectacle_id INT NOT NULL, name VARCHAR(80) NOT NULL, email VARCHAR(255) NOT NULL, nb_place INT NOT NULL, INDEX IDX_42C84955C682915D (spectacle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE show_performs ADD CONSTRAINT FK_546F8C74D0C1FC64 FOREIGN KEY (show_id) REFERENCES `representation` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE show_performs ADD CONSTRAINT FK_546F8C74D0865E2E FOREIGN KEY (performs_id) REFERENCES performs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955C682915D FOREIGN KEY (spectacle_id) REFERENCES `representation` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE show_performs DROP FOREIGN KEY FK_546F8C74D0865E2E');
        $this->addSql('ALTER TABLE show_performs DROP FOREIGN KEY FK_546F8C74D0C1FC64');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955C682915D');
        $this->addSql('DROP TABLE performs');
        $this->addSql('DROP TABLE `representation`');
        $this->addSql('DROP TABLE show_performs');
        $this->addSql('DROP TABLE reservation');
    }
}
