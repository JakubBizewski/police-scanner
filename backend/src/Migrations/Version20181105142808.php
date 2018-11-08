<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181105142808 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE offense (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, fine INT NOT NULL, is_felony TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_registration (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, vehicle_id INT DEFAULT NULL, number VARCHAR(10) NOT NULL, create_time DATETIME NOT NULL, expire_time DATETIME NOT NULL, INDEX IDX_DB4048D37E3C61F9 (owner_id), UNIQUE INDEX UNIQ_DB4048D3545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_model (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, name VARCHAR(50) NOT NULL, mass INT NOT NULL, power INT NOT NULL, torque INT NOT NULL, INDEX IDX_B53AF23544F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE citation (id INT AUTO_INCREMENT NOT NULL, citizen_id INT NOT NULL, offense_id INT DEFAULT NULL, INDEX IDX_FABD9C7EA63C3C2E (citizen_id), INDEX IDX_FABD9C7E3A61EAFD (offense_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, vehicle_model_id INT NOT NULL, vin VARCHAR(255) NOT NULL, colour VARCHAR(100) NOT NULL, production_year DATETIME NOT NULL, INDEX IDX_1B80E486A467B873 (vehicle_model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_insurance (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT NOT NULL, owner_id INT NOT NULL, create_time DATETIME NOT NULL, expire_time DATETIME NOT NULL, UNIQUE INDEX UNIQ_93B1EA1E545317D1 (vehicle_id), INDEX IDX_93B1EA1E7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE citizen (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, date_of_birth DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicle_registration ADD CONSTRAINT FK_DB4048D37E3C61F9 FOREIGN KEY (owner_id) REFERENCES citizen (id)');
        $this->addSql('ALTER TABLE vehicle_registration ADD CONSTRAINT FK_DB4048D3545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF23544F5D008 FOREIGN KEY (brand_id) REFERENCES vehicle_brand (id)');
        $this->addSql('ALTER TABLE citation ADD CONSTRAINT FK_FABD9C7EA63C3C2E FOREIGN KEY (citizen_id) REFERENCES citizen (id)');
        $this->addSql('ALTER TABLE citation ADD CONSTRAINT FK_FABD9C7E3A61EAFD FOREIGN KEY (offense_id) REFERENCES offense (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486A467B873 FOREIGN KEY (vehicle_model_id) REFERENCES vehicle_model (id)');
        $this->addSql('ALTER TABLE vehicle_insurance ADD CONSTRAINT FK_93B1EA1E545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE vehicle_insurance ADD CONSTRAINT FK_93B1EA1E7E3C61F9 FOREIGN KEY (owner_id) REFERENCES citizen (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE citation DROP FOREIGN KEY FK_FABD9C7E3A61EAFD');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486A467B873');
        $this->addSql('ALTER TABLE vehicle_registration DROP FOREIGN KEY FK_DB4048D3545317D1');
        $this->addSql('ALTER TABLE vehicle_insurance DROP FOREIGN KEY FK_93B1EA1E545317D1');
        $this->addSql('ALTER TABLE vehicle_registration DROP FOREIGN KEY FK_DB4048D37E3C61F9');
        $this->addSql('ALTER TABLE citation DROP FOREIGN KEY FK_FABD9C7EA63C3C2E');
        $this->addSql('ALTER TABLE vehicle_insurance DROP FOREIGN KEY FK_93B1EA1E7E3C61F9');
        $this->addSql('ALTER TABLE vehicle_model DROP FOREIGN KEY FK_B53AF23544F5D008');
        $this->addSql('DROP TABLE offense');
        $this->addSql('DROP TABLE vehicle_registration');
        $this->addSql('DROP TABLE vehicle_model');
        $this->addSql('DROP TABLE citation');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE vehicle_insurance');
        $this->addSql('DROP TABLE citizen');
        $this->addSql('DROP TABLE vehicle_brand');
    }
}
