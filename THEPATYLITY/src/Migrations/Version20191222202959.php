<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191222202959 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image_sal (id INT AUTO_INCREMENT NOT NULL, salle_id INT DEFAULT NULL, img1 VARCHAR(255) DEFAULT NULL, img2 VARCHAR(255) DEFAULT NULL, image3 VARCHAR(255) DEFAULT NULL, img4 VARCHAR(255) DEFAULT NULL, img5 VARCHAR(255) DEFAULT NULL, img6 VARCHAR(255) DEFAULT NULL, img7 VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C9FEA8DDDC304035 (salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_sal ADD CONSTRAINT FK_C9FEA8DDDC304035 FOREIGN KEY (salle_id) REFERENCES salle_loc (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE image_sal');
    }
}
