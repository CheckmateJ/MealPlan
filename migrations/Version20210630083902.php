<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210630083902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meal_plan (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_C7848889A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meal_plan ADD CONSTRAINT FK_C7848889A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE meal_plan_item ADD meal_plan_id INT NOT NULL');
        $this->addSql('ALTER TABLE meal_plan_item ADD CONSTRAINT FK_B4A2EBE7912AB082 FOREIGN KEY (meal_plan_id) REFERENCES meal_plan (id)');
        $this->addSql('CREATE INDEX IDX_B4A2EBE7912AB082 ON meal_plan_item (meal_plan_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meal_plan_item DROP FOREIGN KEY FK_B4A2EBE7912AB082');
        $this->addSql('DROP TABLE meal_plan');
        $this->addSql('DROP INDEX IDX_B4A2EBE7912AB082 ON meal_plan_item');
        $this->addSql('ALTER TABLE meal_plan_item DROP meal_plan_id');
    }
}
