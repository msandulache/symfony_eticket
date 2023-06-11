<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', 'app_index')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/popular', 'app_popular')]
    public function popular(): Response
    {
        return $this->render('popular.html.twig');
    }

    #[Route('/top-rated', 'app_top_rated')]
    public function topRated(): Response
    {
        return $this->render('top-rated.html.twig');
    }

    #[Route('/upcoming', 'app_upcoming')]
    public function upcoming(): Response
    {
        return $this->render('upcoming.html.twig');
    }

    #[Route('/login', 'app_login')]
    public function login(): Response
    {
        return $this->render('login.html.twig');
    }

    #[Route('/register', 'app_register')]
    public function register(): Response
    {
        return $this->render('register.html.twig');
    }

    #[Route('/movie', 'app_movie')]
    public function movie(): Response
    {
        return $this->render('movie.html.twig');
    }
}