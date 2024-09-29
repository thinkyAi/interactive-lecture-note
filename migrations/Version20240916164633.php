<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240916164633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courses ADD studyLevel_id INT UNSIGNED DEFAULT NULL, ADD semesterSession_id INT UNSIGNED DEFAULT NULL, AFTER lecturer_id');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4CE79A35EE FOREIGN KEY (studyLevel_id) REFERENCES study_level (id)');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4CB518FE8C FOREIGN KEY (semesterSession_id) REFERENCES semester_session (id)');
        $this->addSql('CREATE INDEX IDX_A9A55A4CE79A35EE ON courses (studyLevel_id)');
        $this->addSql('CREATE INDEX IDX_A9A55A4CB518FE8C ON courses (semesterSession_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4CE79A35EE');
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4CB518FE8C');
        $this->addSql('DROP INDEX IDX_A9A55A4CE79A35EE ON courses');
        $this->addSql('DROP INDEX IDX_A9A55A4CB518FE8C ON courses');
        $this->addSql('ALTER TABLE courses DROP studyLevel_id, DROP semesterSession_id');
    }
}
