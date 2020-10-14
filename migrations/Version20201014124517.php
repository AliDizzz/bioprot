<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014124517 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address ADD is_invoice_address TINYINT(1) DEFAULT NULL, ADD is_delivery_address TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_F5299398F5B7AF75 ON `order` (address_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP is_invoice_address, DROP is_delivery_address');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398F5B7AF75');
        $this->addSql('DROP INDEX IDX_F5299398F5B7AF75 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP address_id');
    }
}
