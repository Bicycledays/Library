<?php
/*
 * Данный файл содержит миграцию для создания таблицы books в рабочей БД.
 * Таблица содержит следующие поля:
 *      id - идентификационный номер книги;
 *      book_name - наименование книги;
 *      publishing_year - год публикации книги;
 *      book_author - автор книги;
 * Созданная таблица заполняется несколькими книгами из личной библиотеки, чтобы не было слишком пусто
 *
 * (c) Фоменков Виталий <fomenkov94@bk.ru>
 */
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201110173010 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // SQL запрос на создание таблицы books в БД с соответствующими полями
        $this->addSql('CREATE TABLE books (id INT AUTO_INCREMENT NOT NULL, book_name VARCHAR(150) NOT NULL, publishing_year INT NOT NULL, book_author VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // заполнение таблицы books несколькими книгами
        $this->addSql("INSERT INTO `books` (`id`, `book_name`, `publishing_year`, `book_author`) VALUES
                            (NULL, 'Фейнмановские лекции по физике', '1963', 'Ричард Фейнман'),
                            (NULL, 'Слепой часовщик', '1986', 'Ричард Докинз'),
                            (NULL, 'Последнее желание', '1993', 'Анджей Сапковский')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE books');
    }
}
