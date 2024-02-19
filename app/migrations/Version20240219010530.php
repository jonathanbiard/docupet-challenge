<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219010530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE breed (id SMALLINT AUTO_INCREMENT NOT NULL, pet_type SMALLINT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_dangerous TINYINT(1) NOT NULL, INDEX IDX_F8AF884F9796B243 (pet_type), UNIQUE INDEX breed_name_uindex (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pet (id INT AUTO_INCREMENT NOT NULL, breed SMALLINT DEFAULT NULL, name VARCHAR(128) NOT NULL, age SMALLINT DEFAULT NULL, birthday DATE DEFAULT NULL, gender enum(\'male\', \'female\'), INDEX pet_name_index (name), INDEX pet_breed_index (breed), INDEX pet_age_index (age), INDEX pet_birthday_index (birthday), INDEX pet_gender_index (gender), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pet_type (id SMALLINT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, UNIQUE INDEX pet_type_name_uindex (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE breed ADD CONSTRAINT FK_F8AF884F9796B243 FOREIGN KEY (pet_type) REFERENCES pet_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pet ADD CONSTRAINT FK_E4529B85F8AF884F FOREIGN KEY (breed) REFERENCES breed (id) ON DELETE CASCADE');

        $this->addSql('insert into pet_type (id, name) values (1, \'Cat\');');
        $this->addSql('insert into pet_type (id, name) values (2, \'Dog\');');

        $this->addSql('insert into breed (id, pet_type, name, is_dangerous) values (1, 1, \'Siamese\', false)');
        $this->addSql('insert into breed (id, pet_type, name, is_dangerous) values (2, 1, \'Persian\', false)');
        $this->addSql('insert into breed (id, pet_type, name, is_dangerous) values (3, 1, \'House\', false)');
        $this->addSql('insert into breed (id, pet_type, name, is_dangerous) values (4, 1, \'Tiger\', true)');
        $this->addSql('insert into breed (id, pet_type, name, is_dangerous) values (5, 2, \'Golden Retriever\', false)');
        $this->addSql('insert into breed (id, pet_type, name, is_dangerous) values (6, 2, \'Border Collie\', false)');
        $this->addSql('insert into breed (id, pet_type, name, is_dangerous) values (7, 2, \'Labrador\', false)');
        $this->addSql('insert into breed (id, pet_type, name, is_dangerous) values (8, 2, \'Wolf\', true)');

        $this->addSql('insert into pet (breed, name, age, birthday, gender) values (3, \'Luvia\', 3, null, \'female\')');
        $this->addSql('insert into pet (breed, name, age, birthday, gender) values (6, \'Suki\', null, \'2021-04-03\', \'female\')');
        $this->addSql('insert into pet (breed, name, age, birthday, gender) values (4, \'Teeth\', 5, null, \'male\')');
        $this->addSql('insert into pet (breed, name, age, birthday, gender) values (8, \'Claws\', 6, null, \'male\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE breed DROP FOREIGN KEY FK_F8AF884F9796B243');
        $this->addSql('ALTER TABLE pet DROP FOREIGN KEY FK_E4529B85F8AF884F');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE pet');
        $this->addSql('DROP TABLE pet_type');
    }
}
