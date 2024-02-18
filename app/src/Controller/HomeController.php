<?php
namespace App\Controller;

use Random\RandomException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index(): Response
    {
        try {
            $number = random_int(0, 100);
        } catch (RandomException) {
            $number = 999;
        }

        return $this->render('home.html.twig', [
            'number' => $number,
        ]);
    }
}
