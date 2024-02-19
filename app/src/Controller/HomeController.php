<?php
namespace App\Controller;

use App\Repository\PetRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index(PetRepository $petRepository): Response
    {
        $results = $petRepository->findAll();

        return $this->render('home.html.twig', [
            'pets' => PetRepository::toArray($results),
        ]);
    }
}
