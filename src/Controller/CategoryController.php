<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'category_show')]
    public function index(CategoryRepository $categoryRepository, String $slug): Response
    {
        $category = $categoryRepository->findOneBy(compact('slug'));
        if(!$category)
        {
            throw $this->createNotFoundException("La catégorie demandée n'existe pas !");
        }

        return $this->render(
            'category/show.html.twig',
            compact('slug', 'category')
        );
    }
}
