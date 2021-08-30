<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210810144639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(100) NOT NULL, create_at DATETIME NOT NULL, city VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, zipCode VARCHAR(255) NOT NULL, numberHouse VARCHAR(255) NOT NULL, tax_number INT NOT NULL, salary DOUBLE PRECISION NOT NULL, gross TINYINT(1) NOT NULL, INDEX IDX_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', task_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name_files VARCHAR(200) NOT NULL, path_file VARCHAR(255) NOT NULL, type_ext VARCHAR(255) NOT NULL, created_At DATETIME NOT NULL, INDEX IDX_6354059A76ED395 (user_id), INDEX IDX_63540598DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', wallet_control_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', client_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', title_task VARCHAR(200) NOT NULL, status VARCHAR(255) NOT NULL, number_count_character INT NOT NULL, task_date_create_at DATETIME NOT NULL, task_date_task_date_at DATETIME NOT NULL, task_date_dead_line_at DATETIME NOT NULL, task_date_finish_task_at DATETIME NOT NULL, typeText_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', UNIQUE INDEX UNIQ_527EDB25B5E1F8CC (wallet_control_id), INDEX IDX_527EDB2519EB6921 (client_id), INDEX IDX_527EDB25A76ED395 (user_id), INDEX IDX_527EDB257CD4806F (typeText_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_text (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', destination VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_EC8462CFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', wallet_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', username VARCHAR(50) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, enabled TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', auth_type_auth INT DEFAULT NULL, auth_code_auth VARCHAR(255) DEFAULT NULL, auth_date_authAt DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649712520F3 (wallet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_users (task_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_D327BEC98DB60186 (task_id), INDEX IDX_D327BEC9A76ED395 (user_id), PRIMARY KEY(task_id, user_id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallet (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', earn_money DOUBLE PRECISION NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallet_control (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', wallet_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', created_at DATETIME NOT NULL, earn_money DOUBLE PRECISION NOT NULL, INDEX IDX_9CDA095D712520F3 (wallet_id), INDEX IDX_9CDA095DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_6354059A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_63540598DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25B5E1F8CC FOREIGN KEY (wallet_control_id) REFERENCES wallet_control (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB257CD4806F FOREIGN KEY (typeText_id) REFERENCES type_text (id)');
        $this->addSql('ALTER TABLE type_text ADD CONSTRAINT FK_EC8462CFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE task_users ADD CONSTRAINT FK_D327BEC98DB60186 FOREIGN KEY (task_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE task_users ADD CONSTRAINT FK_D327BEC9A76ED395 FOREIGN KEY (user_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE wallet_control ADD CONSTRAINT FK_9CDA095D712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE wallet_control ADD CONSTRAINT FK_9CDA095DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2519EB6921');
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_63540598DB60186');
        $this->addSql('ALTER TABLE task_users DROP FOREIGN KEY FK_D327BEC9A76ED395');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB257CD4806F');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_6354059A76ED395');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25A76ED395');
        $this->addSql('ALTER TABLE type_text DROP FOREIGN KEY FK_EC8462CFA76ED395');
        $this->addSql('ALTER TABLE task_users DROP FOREIGN KEY FK_D327BEC98DB60186');
        $this->addSql('ALTER TABLE wallet_control DROP FOREIGN KEY FK_9CDA095DA76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649712520F3');
        $this->addSql('ALTER TABLE wallet_control DROP FOREIGN KEY FK_9CDA095D712520F3');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25B5E1F8CC');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE type_text');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE task_users');
        $this->addSql('DROP TABLE wallet');
        $this->addSql('DROP TABLE wallet_control');
    }
}
