<?php

namespace App\Repository;

use App\Repository\MovieRepositoryInterface;
use App\Exceptions\InvalidResponseException;
use GuzzleHttp\Client;

class TheMovieDbRepository implements MovieRepositoryInterface
{
    protected const API_KEY = 'b6c34a9131a4ea9fd627daa3e12e439f';
    protected const URL = 'https://api.themoviedb.org/3';
    protected const STATUS_CODE_OK = 200;
    protected const REASON_PHRASE_OK = 'OK';

    protected string $images_base_url = '';
    protected string $images_secure_base_url = '';
    protected string $images_backdrop_size = '';
    protected string $images_logo_size = '';
    protected string $images_poster_size = '';

    public function __construct() {

        $response = $this->get('/configuration');
        $this->images_base_url = $response['images']['base_url'] ?? $response['images']['base_url'];
        $this->images_secure_base_url = $response['images']['secure_base_url'] ?? $response['images']['secure_base_url'];
        $this->images_backdrop_size = $response['images']['backdrop_sizes'][0] ?? $response['images']['backdrop_sizes'][0];

    }

    public function getNowPlayingMovies(): array
    {
        return $this->getMovies('now_playing');
    }

    public function getPopularMovies(): array
    {
        return $this->getMovies('popular');
    }

    public function getTopRatedMovies(): array
    {
        return $this->getMovies('top_rated');
    }

    public function getUpcomingMovies(): array
    {
        return $this->getMovies('upcoming');
    }

    public function getMovieDetails(int $movieId): array
    {
        $response =  $this->get('/movie/' . $movieId);

        return [
            'genres' => $this->getGenres($response),
            'short_description' => $response['overview'],
            'poster_path' => $this->images_secure_base_url . $this->images_backdrop_size . $response['poster_path'],
            'release_date' => $response['release_date'],
            'status' => $response['status'],
            'title' =>  $response['title'],
            'tagline' =>  $response['tagline'],
            'vote_average' => $response['vote_average']
        ];
    }

    private function getMovies(string $queryString): array
    {
        $movies = [];
        $response = $this->get('/movie/' . $queryString);
        if(isset($response['results'])) {
            foreach($response['results'] as $result) {
                if(isset($result['title']) && $result['poster_path'] && $result['overview']) {
                    $movies[] = [
                        'id' => $result['id'],
                        'title' => $result['title'],
                        'poster_path' => $this->images_base_url . $this->images_backdrop_size . $result['poster_path'],
                        'overview' => $result['overview']
                    ];
                }
            }
        }

        return $movies;
    }

    private function get($queryString)
    {
        $client = new Client();
        $response = $client->get(self::URL . $queryString . '?api_key=' . self::API_KEY);
        if($this->isValid($response)) {
            $body = $response->getBody()->getContents();
            $body = json_decode($body, true);

            return $body;
        } else {
            throw new InvalidResponseException('Error: Response is not valid');
        }
    }

    private function isValid($response)
    {
        if(
            $response->getStatusCode() == self::STATUS_CODE_OK &&
            $response->getReasonPhrase() == self::REASON_PHRASE_OK
        ) {
            return true;
        } else {
            return false;
        }
    }

    private function getGenres($response)
    {
        $genreNames = [];
        if(isset($response['genres'])) {
            foreach($response['genres'] as $genre) {
                $genreNames[] = $genre['name'];
            }
        }

        return implode(', ', $genreNames);
    }
}