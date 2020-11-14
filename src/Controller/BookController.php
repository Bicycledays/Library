<?php
/*
 * Данный файл содержит класс BookController с контроллерами для работы с тремя страницами приложения Библиотека:
 *      showBooks - рендерит страницу со всеми книгами из таблицы books в вашей БД;
 *      createBook - рендерит страницу для добавления новой книги в books;
 *      editBook - рендерит страницу для редактирования или удаления книги в books
 *
 * (c) Фоменков Виталий <fomenkov94@bk.ru>
 */
namespace App\Controller;

use App\Entity\Books;
use App\Form\BookType;
use App\Services\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * Отображение всех книг
     *
     * Контроллер отображает страницу со всеми объектами (книгами) сущности Books,
     * если книг нет, то перенаправляет на страницу создания новой книги
     *
     * @Route("/", name="books")
     */
    public function showBooks(): Response
    {
        // записываем в $books все объекты (все книги) сущности Books, используя Doctrine
        $books = $this->getDoctrine()->getRepository(Books::class)->findAll();

        // если книг не существует, то перенаправляем на страницу создания новой книги
        if (!$books) {
            return $this->redirectToRoute('createBook');
        }

        return $this->render('/list_books/index.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * Создание новой книги
     *
     * Контроллер отображает страницу с формой для создания новой книги.
     * Форма собирается из BookType.php.
     * Сохранение данных, полученных с формы, реализовано в сервисе saveBook (BookService.php).
     * Новая книга сохраняется в сущность Books
     *
     * @Route("/createBook", name="createBook")
     */
    public function createBook(Request $request, BookService $bookService): Response
    {
        $form = $this->createForm(BookType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $bookService->saveBook($form->getData());
        }

        return $this->render('/create_book/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Редактирование или удаление книги
     *
     * Контроллер отображает страницу с формой для редактирования или удаления
     * конкретного объекта сущности Books. Объект определяется по id, который передается
     * при вызове контроллера с главной страницы (список книг).
     * Форма собирается из BookType.php.
     * Сохранение данных, полученных с формы, реализовано в сервисе saveBook (BookService.php).
     * Удаление данных, полученных с формы, реализовано в сервисе deleteBook (BookService.php).
     *
     * @Route("/editBook/{id}", name="editBook")
     */
    public function editBook(Request $request, int $id, BookService $bookService): Response
    {

        $book = $this->getDoctrine()->getRepository(Books::class)->find($id);
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // если была нажата кнопка сохранить, то из сервиса BookService будет вызван метод saveBook
            // если была нажата кнопка удалить, то из сервиса BookService будет вызван метод deleteBook
            return $form->get('save')->isClicked() ? $bookService->saveBook($book) : $bookService->deleteBook($book);
        }

        return $this->render('/edit_book/index.html.twig', [
            'form' => $form->createView(),
            'book' => $book,
        ]);
    }
}
