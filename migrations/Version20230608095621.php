<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608095621 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // Create the 'movie' table
        $this->addSql('CREATE TABLE IF NOT EXISTS movie (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            duration INT NOT NULL
        ) ENGINE = InnoDB');

        // Create the 'people' table
        $this->addSql('CREATE TABLE IF NOT EXISTS people (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            date_of_birth DATE NOT NULL,
            nationality VARCHAR(255) NOT NULL
        ) ENGINE = InnoDB');

        // Create the 'movie_has_people' table
        $this->addSql('CREATE TABLE IF NOT EXISTS movie_has_people (
            Movie_id INT NOT NULL,
            People_id INT NOT NULL,
            role VARCHAR(255) NOT NULL,
            significance ENUM("principal", "secondaire") DEFAULT NULL,
            PRIMARY KEY (Movie_id, People_id),
            CONSTRAINT fk_Movie_has_People_Movie1 FOREIGN KEY (Movie_id) REFERENCES movie (id),
            CONSTRAINT fk_Movie_has_People_People1 FOREIGN KEY (People_id) REFERENCES people (id)
        ) ENGINE = InnoDB');

        // Create the 'type' table
        $this->addSql('CREATE TABLE IF NOT EXISTS type (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        ) ENGINE = InnoDB');

        // Create the 'movie_has_type' table
        $this->addSql('CREATE TABLE IF NOT EXISTS movie_has_type (
            Movie_id INT NOT NULL,
            Type_id INT NOT NULL,
            PRIMARY KEY (Movie_id, Type_id),
            CONSTRAINT fk_Movie_has_Type_Movie1 FOREIGN KEY (Movie_id) REFERENCES movie (id),
            CONSTRAINT fk_Movie_has_Type_Type1 FOREIGN KEY (Type_id) REFERENCES type (id)
        ) ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // Drop the 'movie_has_type' table
        $this->addSql('DROP TABLE IF EXISTS movie_has_type');

        // Drop the 'type' table
        $this->addSql('DROP TABLE IF EXISTS type');

        // Drop the 'movie_has_people' table
        $this->addSql('DROP TABLE IF EXISTS movie_has_people');

        // Drop the 'people' table
        $this->addSql('DROP TABLE IF EXISTS people');

        // Drop the 'movie' table
        $this->addSql('DROP TABLE IF EXISTS movie');
    }
}
