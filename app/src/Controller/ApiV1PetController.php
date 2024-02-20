<?php
namespace App\Controller;

use App\Entity\Pet;
use App\Factory\PetFactory;
use App\Repository\PetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiV1PetController extends AbstractController
{
    #[Route('/api/v1/pet', methods: ['GET'])]
    public function findAll(PetRepository $petRepository): Response
    {
        $results = $petRepository->findAll();

        return $this->json(PetRepository::toArray($results), Response::HTTP_OK, [
            'Content-Type' => 'application/json',
        ]);
    }

    #[Route('/api/v1/pet/{id}', methods: ['GET'])]
    public function findOne(int $id, PetRepository $petRepository): Response
    {
        $result = $petRepository->findOneBy([ 'id' => $id ]);

        return $this->json($result->getAsArray(), Response::HTTP_OK, [
            'Content-Type' => 'application/json',
        ]);
    }

    #[Route('/api/v1/pet', methods: ['POST'])]
    public function saveOne(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = $request->getPayload();

        $pet = PetFactory::create(
            $entityManager,
            $data->get('name'),
            $data->get('breed'),
            $data->get('breedMix'),
            $data->get('birthday'),
            $data->get('age'),
            $data->get('gender')
        );

        if ($pet instanceof Pet) {
            // Seems to be no exceptions thrown or errors reported for these external calls
            $entityManager->persist($pet);
            $entityManager->flush();

            return $this->json($pet->getAsArray(), Response::HTTP_CREATED, [
                'Content-Type' => 'application/json',
            ]);
        }

        return $this->json([ 'errorCode' => $pet ], Response::HTTP_BAD_REQUEST, [
            'Content-Type' => 'application/json',
        ]);
    }
}
