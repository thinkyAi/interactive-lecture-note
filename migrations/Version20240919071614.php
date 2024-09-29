<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240919071614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course_outlines (id INT UNSIGNED AUTO_INCREMENT NOT NULL, course_id INT UNSIGNED DEFAULT NULL, lecturer_id INT UNSIGNED DEFAULT NULL, module_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, objective LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_629DCBF8591CC992 (course_id), INDEX IDX_629DCBF8BA2D8762 (lecturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timelines (id INT UNSIGNED AUTO_INCREMENT NOT NULL, week_number VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, courseOutline_id INT UNSIGNED DEFAULT NULL, INDEX IDX_BF99F5A013F6626 (courseOutline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course_outlines ADD CONSTRAINT FK_629DCBF8591CC992 FOREIGN KEY (course_id) REFERENCES courses (id)');
        $this->addSql('ALTER TABLE course_outlines ADD CONSTRAINT FK_629DCBF8BA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturers (id)');
        $this->addSql('ALTER TABLE timelines ADD CONSTRAINT FK_BF99F5A013F6626 FOREIGN KEY (courseOutline_id) REFERENCES course_outlines (id)');
        $this->addSql('ALTER TABLE lecture_timeline DROP FOREIGN KEY FK_2ACE17D835E32FCD');
        $this->addSql('DROP TABLE lecture_timeline');
        $this->addSql('ALTER TABLE all_courses ADD CONSTRAINT FK_339E0A02E79A35EE FOREIGN KEY (studyLevel_id) REFERENCES study_levels (id)');
        $this->addSql('ALTER TABLE all_courses ADD CONSTRAINT FK_339E0A02B518FE8C FOREIGN KEY (semesterSession_id) REFERENCES semester_sessions (id)');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4CE79A35EE FOREIGN KEY (studyLevel_id) REFERENCES study_levels (id)');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4CB518FE8C FOREIGN KEY (semesterSession_id) REFERENCES semester_sessions (id)');
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D0BA2D8762');
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D0591CC992');
        $this->addSql('DROP INDEX IDX_63C861D0BA2D8762 ON lectures');
        $this->addSql('DROP INDEX IDX_63C861D0591CC992 ON lectures');
        $this->addSql('ALTER TABLE lectures ADD courseOutline_id INT UNSIGNED DEFAULT NULL, DROP lecturer_id, DROP course_id');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D013F6626 FOREIGN KEY (courseOutline_id) REFERENCES course_outlines (id)');
        $this->addSql('CREATE INDEX IDX_63C861D013F6626 ON lectures (courseOutline_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lectures DROP FOREIGN KEY FK_63C861D013F6626');
        $this->addSql('CREATE TABLE lecture_timeline (id INT UNSIGNED AUTO_INCREMENT NOT NULL, lecture_id INT UNSIGNED DEFAULT NULL, week_number VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_2ACE17D835E32FCD (lecture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lecture_timeline ADD CONSTRAINT FK_2ACE17D835E32FCD FOREIGN KEY (lecture_id) REFERENCES lectures (id)');
        $this->addSql('ALTER TABLE course_outlines DROP FOREIGN KEY FK_629DCBF8591CC992');
        $this->addSql('ALTER TABLE course_outlines DROP FOREIGN KEY FK_629DCBF8BA2D8762');
        $this->addSql('ALTER TABLE timelines DROP FOREIGN KEY FK_BF99F5A013F6626');
        $this->addSql('DROP TABLE course_outlines');
        $this->addSql('DROP TABLE timelines');
        $this->addSql('ALTER TABLE all_courses DROP FOREIGN KEY FK_339E0A02E79A35EE');
        $this->addSql('ALTER TABLE all_courses DROP FOREIGN KEY FK_339E0A02B518FE8C');
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4CE79A35EE');
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4CB518FE8C');
        $this->addSql('DROP INDEX IDX_63C861D013F6626 ON lectures');
        $this->addSql('ALTER TABLE lectures ADD course_id INT UNSIGNED DEFAULT NULL, CHANGE courseOutline_id lecturer_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D0BA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturers (id)');
        $this->addSql('ALTER TABLE lectures ADD CONSTRAINT FK_63C861D0591CC992 FOREIGN KEY (course_id) REFERENCES courses (id)');
        $this->addSql('CREATE INDEX IDX_63C861D0BA2D8762 ON lectures (lecturer_id)');
        $this->addSql('CREATE INDEX IDX_63C861D0591CC992 ON lectures (course_id)');
    }
}
