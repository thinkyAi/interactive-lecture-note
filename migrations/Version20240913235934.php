<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240913235934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE all_courses (id INT UNSIGNED AUTO_INCREMENT NOT NULL, course_code VARCHAR(255) NOT NULL, course_title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, studyLevel_id INT UNSIGNED DEFAULT NULL, semesterSession_id INT UNSIGNED DEFAULT NULL, INDEX IDX_339E0A02E79A35EE (studyLevel_id), INDEX IDX_339E0A02B518FE8C (semesterSession_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semester_session (id INT UNSIGNED AUTO_INCREMENT NOT NULL, semester_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE study_level (id INT UNSIGNED AUTO_INCREMENT NOT NULL, study_level VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE all_courses ADD CONSTRAINT FK_339E0A02E79A35EE FOREIGN KEY (studyLevel_id) REFERENCES study_level (id)');
        $this->addSql('ALTER TABLE all_courses ADD CONSTRAINT FK_339E0A02B518FE8C FOREIGN KEY (semesterSession_id) REFERENCES semester_session (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE all_courses DROP FOREIGN KEY FK_339E0A02E79A35EE');
        $this->addSql('ALTER TABLE all_courses DROP FOREIGN KEY FK_339E0A02B518FE8C');
        $this->addSql('DROP TABLE all_courses');
        $this->addSql('DROP TABLE semester_session');
        $this->addSql('DROP TABLE study_level');
    }
}
