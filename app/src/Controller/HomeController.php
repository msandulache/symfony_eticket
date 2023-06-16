<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MovieRepositoryInterface;

class HomeController extends AbstractController
{
    public function __construct(protected MovieRepositoryInterface $movieDbAdapter)
    {
    }

    #[Route('/', 'app_index')]
    public function index()
    {
        return $this->render('index.html.twig', [
            'movies' => $this->movieDbAdapter->getNowPlayingMovies()
        ]);
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

    #[Route('/contact', 'app_contact')]
    public function contact(): Response
    {
        return $this->render('contact.html.twig');
    }

    #[Route('/ticket', 'app_ticket')]
    public function ticket(): Response
    {
        return $this->render('ticket.html.twig');
    }

    #[Route('/cart', 'app_cart')]
    public function cart(): Response
    {
        return $this->render('cart.html.twig');
    }

    #[Route('/checkout', 'app_checkout')]
    public function checkout(): Response
    {
        return $this->render('checkout.html.twig');
    }

    #[Route('/thank-you', 'app_thank_you')]
    public function thankYou(): Response
    {
        return $this->render('thank-you.html.twig');
    }

    #[Route('/account', 'app_account')]
    public function account(): Response
    {
        return $this->render('account.html.twig');
    }

    #[Route('/order-history', 'app_order_history')]
    public function orderHistory(): Response
    {
        return $this->render('order-history.html.twig');
    }

    #[Route('/password-recovery', 'app_password_recovery')]
    public function passwordRecovery(): Response
    {
        return $this->render('password-recovery.html.twig');
    }

    #[Route('/ticket-history', 'app_ticket_history')]
    public function ticketHistory(): Response
    {
        return $this->render('ticket-history.html.twig');
    }
}