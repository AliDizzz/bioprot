<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014123550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_line ADD new_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE1CAF6E114 FOREIGN KEY (new_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_9CE58EE1CAF6E114 ON order_line (new_order_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE1CAF6E114');
        $this->addSql('DROP INDEX IDX_9CE58EE1CAF6E114 ON order_line');
        $this->addSql('ALTER TABLE order_line DROP new_order_id');
    }
}
