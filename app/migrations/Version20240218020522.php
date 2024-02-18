<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240218020522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial migration and seeding for the Docupet Full-Stack Coding Challenge';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(file_get_contents(__DIR__ . '/initial-sql/schema.sql'));
        $this->addSql(file_get_contents(__DIR__ . '/initial-sql/seed.sql'));

        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE breed DROP FOREIGN KEY breed_pet_type_id_fk');
        $this->addSql('ALTER TABLE pet DROP FOREIGN KEY pet_breed_id_fk');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE pet');
        $this->addSql('DROP TABLE pet_type');

        $this->addSql('DROP TABLE messenger_messages');
    }
}
