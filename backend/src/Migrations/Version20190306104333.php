<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190306104333 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE visa (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, create_time DATETIME NOT NULL, expire_time DATETIME NOT NULL, UNIQUE INDEX UNIQ_16B1AB087E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visa ADD CONSTRAINT FK_16B1AB087E3C61F9 FOREIGN KEY (owner_id) REFERENCES citizen (id)');
        $this->addSql('ALTER TABLE vehicle_registration CHANGE vehicle_id vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE citation CHANGE offense_id offense_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE citizen ADD place_of_birth VARCHAR(50) NOT NULL, ADD nationality VARCHAR(50) NOT NULL, ADD height INT NOT NULL, ADD weight INT NOT NULL, ADD address_street VARCHAR(150) NOT NULL, ADD address_city VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE visa');
        $this->addSql('ALTER TABLE citation CHANGE offense_id offense_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE citizen DROP place_of_birth, DROP nationality, DROP height, DROP weight, DROP address_street, DROP address_city');
        $this->addSql('ALTER TABLE vehicle_registration CHANGE vehicle_id vehicle_id INT DEFAULT NULL');
    }
}
