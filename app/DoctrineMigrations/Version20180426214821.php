<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180426214821 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, occupation_id INT DEFAULT NULL, country_id INT DEFAULT NULL, firstname VARCHAR(20) NOT NULL, lastname VARCHAR(50) NOT NULL, experience SMALLINT NOT NULL, city VARCHAR(50) NOT NULL, INDEX INDEX_8D93D64922C8FC20 (occupation_id), INDEX INDEX_8D93D649F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_availability (user_id INT NOT NULL, availability_id INT NOT NULL, INDEX IDX_BF7BDEBDA76ED395 (user_id), INDEX IDX_BF7BDEBD61778466 (availability_id), PRIMARY KEY(user_id, availability_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64922C8FC20 FOREIGN KEY (occupation_id) REFERENCES occupation (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE user_availability ADD CONSTRAINT FK_BF7BDEBDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_availability ADD CONSTRAINT FK_BF7BDEBD61778466 FOREIGN KEY (availability_id) REFERENCES availability (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_availability DROP FOREIGN KEY FK_BF7BDEBDA76ED395');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_availability');
    }
}
