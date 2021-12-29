<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228214715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artical ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE artical ADD CONSTRAINT FK_CE48C88FF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CE48C88FF675F31B ON artical (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artical DROP FOREIGN KEY FK_CE48C88FF675F31B');
        $this->addSql('DROP INDEX IDX_CE48C88FF675F31B ON artical');
        $this->addSql('ALTER TABLE artical DROP author_id');
    }
}
