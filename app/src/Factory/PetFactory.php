<?php
namespace App\Factory;

use App\Entity\Breed;
use App\Entity\Pet;
use Doctrine\ORM\EntityManagerInterface;

class PetFactory
{
    public static function create(
        EntityManagerInterface $entityManager,
        ?string $name,
        ?string $breed,
        ?string $breedMix,
        ?string $birthday,
        ?int $age,
        ?string $gender,
    ): Pet | int
    {
        if (!self::validateName($name)) {
            return 1;
        }
        if (!self::validateBirthdayAndAge($birthday, $age)) {
            return 2;
        }
        if (!self::validateGender($gender)) {
            return 3;
        }
        if (!self::validateBreedAndBreedMix($breed, $breedMix)) {
            return 4;
        }

        $breedEntity = $entityManager->getRepository(Breed::class)->findOneBy(['name' => $breed]);

        if ($breed && !$breedEntity instanceof Breed) {
            return 5;
        }

        $pet = new Pet();
        $pet->setName($name);
        $pet->setBreed($breed ? $breedEntity : null);
        $pet->setBreedMix($breedMix ?: null);
        $pet->setBirthday($birthday ? \DateTime::createFromFormat('Y-m-d', $birthday) : null);
        $pet->setAge($age ?: null);
        $pet->setGender($gender);

        return $pet;
    }

    private static function validateName($name): bool {
        if (!$name) {
            return false;
        }

        return true;
    }

    private static function validateBreedAndBreedMix($breed, $breedMix): bool {
        if (!$breed && !$breedMix) {
            return false;
        }

        return true;
    }

    private static function validateBirthdayAndAge($birthday, $age): bool {
        if (!$birthday && !$age) {
            return false;
        }

        if ($birthday) {
            $parsedDate = \DateTime::createFromFormat('Y-m-d', $birthday);

            if (!$parsedDate) {
                return false;
            }
        } elseif ($age < 1 || $age > 20) {
            return false;
        }

        return true;
    }

    private static function validateGender($gender): bool {
        if (!in_array($gender, [ 'male', 'female' ])) {
            return false;
        }

        return true;
    }
}
