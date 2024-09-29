<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240916004424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE courses (id INT UNSIGNED AUTO_INCREMENT NOT NULL, lecturer_id INT UNSIGNED DEFAULT NULL, course_code VARCHAR(255) NOT NULL, course_title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, objective LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A9A55A4CBA2D8762 (lecturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecture_timeline (id INT UNSIGNED AUTO_INCREMENT NOT NULL, lecture_id INT UNSIGNED DEFAULT NULL, week_number VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_2ACE17D835E32FCD (lecture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lectures (id INT UNSIGNED AUTO_INCREMENT NOT NULL, lecturer_id INT UNSIGNED DEFAULT NULL, course_id INT UNSIGNED DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_63C861D0BA2D8762 (lecturer_id), INDEX IDX_63C861D0591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4CBA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturers (id)');
        $this->addSql('ALTER TABLE lecture_timeline ADD CONSTRAINT FK_2ACE17D835E32FCD FOREIGN KEY (lecture_id) REFERENCES lectures (id)');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D0BA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturers (id)');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D0591CC992 FOREIGN KEY (course_id) REFERENCES courses (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4CBA2D8762');
        $this->addSql('ALTER TABLE lecture_timeline DROP FOREIGN KEY FK_2ACE17D835E32FCD');
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D0BA2D8762');
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D0591CC992');
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP TABLE lecture_timeline');
        $this->addSql('DROP TABLE lectures');
    }
}
