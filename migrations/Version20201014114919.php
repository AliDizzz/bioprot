<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014114919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('DROP INDEX IDX_9474526CA76ED395 ON comment');
        $this->addSql('ALTER TABLE comment DROP user_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADF8697D13');
        $this->addSql('DROP INDEX FK_D34A04ADF8697D13 ON product');
        $this->addSql('ALTER TABLE product DROP comment_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('ALTER TABLE product ADD comment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id)');
        $this->addSql('CREATE INDEX FK_D34A04ADF8697D13 ON product (comment_id)');
    }
}
