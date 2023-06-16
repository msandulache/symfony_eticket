<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MovieRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    public function __construct(protected MovieRepositoryInterface $movieDbAdapter)
    {
    }

    #[Route('/popular', 'app_popular')]
    public function popular(): Response
    {
        return $this->render('popular.html.twig', [
            'movies' => $this->movieDbAdapter->getPopularMovies()
        ]);
    }

    #[Route('/romanian-movies', 'app_romanian_movies')]
    public function romanianMovies(): Response
    {
        return $this->render('romaninan-movies.html.twig', [
            'movies' => $this->movieDbAdapter->getRomanianMovies()
        ]);
    }

    #[Route('/french-movies', 'app_french_movies')]
    public function frenchMovies(): Response
    {
        return $this->render('french-movies.html.twig', [
            'movies' => $this->movieDbAdapter->getFrenchMovies()
        ]);
    }

    #[Route('/movie/{id}', 'app_movie')]
    public function movie($id): Response
    {
        return $this->render('movie.html.twig',
        [
            'movie' => $this->movieDbAdapter->getMovieDetails($id),
            'recommendations' => $this->movieDbAdapter->getRecommendations($id)
        ]);
    }

}