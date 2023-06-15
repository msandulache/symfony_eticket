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

    #[Route('/top-rated', 'app_top_rated')]
    public function topRated(): Response
    {
        return $this->render('top-rated.html.twig', [
            'movies' => $this->movieDbAdapter->getTopRatedMovies()
        ]);
    }

    #[Route('/upcoming', 'app_upcoming')]
    public function upcoming(): Response
    {
        return $this->render('upcoming.html.twig', [
            'movies' => $this->movieDbAdapter->getUpcomingMovies()
        ]);
    }

    public function details(int $movieId): array
    {
        $movie = $this->movieDbAdapter->getMovieDetails($movieId);

        return [
            'id' => isset($movie['id']) ? 'movie-' . $movie['id'] : '',
            'title' => $movie['title'] ?? '',
            'subtitle' => $movie['tagline'] ?? '',
            'movie' => $movie
        ];
    }
}