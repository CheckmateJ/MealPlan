<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210630083242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meal_plan_item (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, day VARCHAR(255) NOT NULL, meal VARCHAR(255) NOT NULL, INDEX IDX_B4A2EBE7591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meal_plan_item ADD CONSTRAINT FK_B4A2EBE7591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6BAF78705E237E06 ON ingredient (name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE meal_plan_item');
        $this->addSql('DROP INDEX UNIQ_6BAF78705E237E06 ON ingredient');
    }
}
