<?php

namespace App\Repository;

interface MovieRepositoryInterface
{
    public function getNowPlayingMovies(): array;
    public function getPopularMovies(): array;
    public function getTopRatedMovies(): array;
    public function getUpcomingMovies(): array;
    public function getMovieDetails(int $movieId): array;
}