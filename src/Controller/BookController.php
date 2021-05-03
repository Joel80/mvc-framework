<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="app_book")
     */
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    /**
     * @Route("/book/all", name="app_find_all_book")
     */
    public function findAllBook(EntityManagerInterface $entityManager): Response
    {
        $books = $entityManager
            ->getRepository(Book::class)
            ->findAll();
        //return $this->json($books);
        return $this->render('book/find_all.html.twig', ['books' => $books]);
    }
}
