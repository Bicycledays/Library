<?php
/*
 * Данный файл содержит класс с сервисами для сохранения, редактирования и удаления объектов в сущность Books:
 *      saveBook - сохраняет или обновляет (редактирует) книгу в Books;
 *      deleteBook - удаляет книгу.
 *
 * (c) Фоменков Виталий <fomenkov94@bk.ru>
 */

namespace App\Services;


use App\Entity\Books;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookService extends AbstractController
{
    /*
     * Сервис вызывается из контроллеров:
     *      createBook - для создания книги;
     *      editBook - для обновления полей книги в БД.
     * Принимает объект с данными из формы, заполненной посетителем.
     * В конце реализации сервис перенаправляет на главную страницу Библиотеки.
     */
    public function saveBook(Books $book): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();

        return $this->redirectToRoute('books');
    }

    /*
     * Сервис вызывается из контроллера editBook - для удаления книги из БД.
     * Принимает объект с данными из формы, заполненной посетителем.
     * В конце реализации сервис перенаправляет на главную страницу Библиотеки.
     */
    public function deleteBook(Books $book): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();

        return $this->redirectToRoute('books');
    }
}