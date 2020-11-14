<?php
/*
 * Данный файл содержит класс-сущность Books для работы с тремя страницами приложения Библиотека.
 * Сущность Books (таблица books в рабочей БД) имеет следующие поля:
 *      id - идентификационный номер книги;
 *      book_name - наименование книги;
 *      publishing_year - год публикации книги;
 *      book_author - автор книги;
 *
 * (c) Фоменков Виталий <fomenkov94@bk.ru>
 */
namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BooksRepository::class)
 */
class Books
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $book_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $publishing_year;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $book_author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookName(): ?string
    {
        return $this->book_name;
    }

    public function setBookName(string $book_name): self
    {
        $this->book_name = $book_name;

        return $this;
    }

    public function getPublishingYear(): ?int
    {
        return $this->publishing_year;
    }

    public function setPublishingYear(int $publishing_year): self
    {
        $this->publishing_year = $publishing_year;

        return $this;
    }

    public function getBookAuthor(): ?string
    {
        return $this->book_author;
    }

    public function setBookAuthor(string $book_author): self
    {
        $this->book_author = $book_author;

        return $this;
    }
}
