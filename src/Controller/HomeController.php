<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(ProductRepository $repository): Response
    {
        $products = $repository->findBy([], [], 3);
        return $this->render('home/index.html.twig', compact('products'));
    }
}
