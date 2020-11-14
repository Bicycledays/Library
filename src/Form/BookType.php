<?php
/*
 * Данный файл содержит класс BookType для описания логики формы.
 * Форма содержит поля, соответствующие сущности Books:
 *      id - идентификационный номер книги;
 *      book_name - наименование книги;
 *      publishing_year - год публикации книги;
 *      book_author - автор книги;
 *      а также кнопку save, которая будет сабмитить форму.
 * Данная форма используется на страницах создания, редактирования или удаления книги.
 *
 * (c) Фоменков Виталий <fomenkov94@bk.ru>
 */
namespace App\Form;

use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('book_name', TextType::class, ['label' => 'Наименование книги'])
            ->add('publishing_year', IntegerType::class, ['label' => 'Год публикации'])
            ->add('book_author',TextType::class, ['label' => 'Автор'])
            ->add('save',SubmitType::class, ['label' => 'Сохранить'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
