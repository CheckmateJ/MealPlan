<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624060322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course_ingredient DROP FOREIGN KEY FK_B44D36F3933FE08C');
        $this->addSql('ALTER TABLE course_ingredient ADD CONSTRAINT FK_B44D36F3933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870A76ED395');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course_ingredient DROP FOREIGN KEY FK_B44D36F3933FE08C');
        $this->addSql('ALTER TABLE course_ingredient ADD CONSTRAINT FK_B44D36F3933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870A76ED395');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
