<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704061345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add data into tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO ingredient_type VALUES
                (1, 'Тесто', 'd'),
                (2, 'Сыр', 'c'),
                (3, 'Начинка', 'i');
        ");

        $this->addSql("
            INSERT INTO ingredient VALUES
            (1, 1, 'Тонкое тесто', 100.00),
            (2, 1, 'Пышное тесто', 110.00),
            (3, 1, 'Ржаное тесто', 150.00),
            (4, 2, 'Моцарелла', 50.00),
            (5, 2, 'Рикотта', 70.00),
            (6, 3, 'Колбаса', 30.00),
            (7, 3, 'Ветчина', 35.00),
            (8, 3, 'Грибы', 50.00),
            (9, 3, 'Томаты', 10.00);
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM ingredient_type WHERE id IN (1,2,3)');
        $this->addSql('DELETE FROM ingredient WHERE id IN (1,2,3,4,5,6,7,8,9)');
    }
}