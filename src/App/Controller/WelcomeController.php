<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WelcomeController extends BaseController
{
    #[Route('/', name: 'app_welcome', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->render('welcome.html.twig');
    }
}
