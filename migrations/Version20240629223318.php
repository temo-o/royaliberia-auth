<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240629223318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial setup for users table';
    }

    public function up(Schema $schema): void
    {

        $this->addSql('CREATE TABLE users(
            id int AUTO_INCREMENT NOT NULL,
            email VARCHAR(254) NOT NULL,
            password VARCHAR(255) NOT NULL,
            first_name VARCHAR(128),
            last_name VARCHAR(128),
            status_flag TINYINT(1) NOT NULL DEFAULT 1,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY(id),
            UNIQUE INDEX email_unique (email)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE=InnoDB'
        );

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
