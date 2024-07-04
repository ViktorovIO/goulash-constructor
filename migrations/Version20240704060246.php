<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704060246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initialize tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE IF NOT EXISTS ingredient_type (
              id INT NOT NULL PRIMARY KEY,
              title VARCHAR(255) DEFAULT NULL,
              code CHAR(1) DEFAULT NULL
            )
        ');

        $this->addSql('
            CREATE TABLE IF NOT EXISTS ingredient (
              id INT NOT NULL PRIMARY KEY,
              type_id INT NOT NULL,
              title VARCHAR(255) NOT NULL,
              price DECIMAL(19, 2) NOT NULL
            )
        ');

        $this->addSql('
            ALTER TABLE ingredient 
              ADD CONSTRAINT FK_ingredient_type_id FOREIGN KEY (type_id)
                REFERENCES ingredient_type(id);
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE custom_table DROP CONSTRAINT IF EXISTS FK_ingredient_type_id');
        $this->addSql('DROP TABLE IF EXISTS ingredient_type');
        $this->addSql('DROP TABLE IF EXISTS ingredient');
    }
}
