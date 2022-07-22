<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220719233221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE private_message ADD sender_id INT DEFAULT NULL, ADD recipient_id INT DEFAULT NULL, ADD is_read TINYINT(1) DEFAULT NULL, DROP sender, DROP receiver, DROP sent_at, CHANGE pm message LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE private_message ADD CONSTRAINT FK_4744FC9BF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE private_message ADD CONSTRAINT FK_4744FC9BE92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4744FC9BF624B39D ON private_message (sender_id)');
        $this->addSql('CREATE INDEX IDX_4744FC9BE92F8F78 ON private_message (recipient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE private_message DROP FOREIGN KEY FK_4744FC9BF624B39D');
        $this->addSql('ALTER TABLE private_message DROP FOREIGN KEY FK_4744FC9BE92F8F78');
        $this->addSql('DROP INDEX IDX_4744FC9BF624B39D ON private_message');
        $this->addSql('DROP INDEX IDX_4744FC9BE92F8F78 ON private_message');
        $this->addSql('ALTER TABLE private_message ADD sender VARCHAR(255) DEFAULT NULL, ADD receiver VARCHAR(255) DEFAULT NULL, ADD sent_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP sender_id, DROP recipient_id, DROP is_read, CHANGE message pm LONGTEXT DEFAULT NULL');
    }
}
