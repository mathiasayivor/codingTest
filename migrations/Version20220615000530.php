<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615000530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', continent_code VARCHAR(2) NOT NULL, currency_code VARCHAR(3) NOT NULL, iso2_code VARCHAR(2) NOT NULL, iso3_code VARCHAR(3) NOT NULL, iso_numeric_code INT NOT NULL, fips_code VARCHAR(2) DEFAULT NULL, calling_code INT DEFAULT NULL, common_name VARCHAR(255) DEFAULT NULL, official_name VARCHAR(255) DEFAULT NULL, endonym VARCHAR(255) DEFAULT NULL, demonym VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', iso_code VARCHAR(3) NOT NULL, iso_numeric_code INT NOT NULL, common_name VARCHAR(100) DEFAULT NULL, official_name VARCHAR(100) DEFAULT NULL, symbol VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE currency');
    }
}
