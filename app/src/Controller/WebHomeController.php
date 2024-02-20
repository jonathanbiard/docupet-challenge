<?php
namespace App\Controller;

use App\Repository\BreedRepository;
use App\Repository\PetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebHomeController extends AbstractController
{
    #[Route('/')]
    public function index(PetRepository $petRepository, BreedRepository $breedRepository): Response
    {
        $pets = $petRepository->findAll();
        $breeds = $breedRepository->findAll();

        return $this->render('home.html.twig', [
            'pets' => PetRepository::toArray($pets),
            'breeds' => BreedRepository::toArray($breeds),
        ]);
    }
}
