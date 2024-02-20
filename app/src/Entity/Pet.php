<?php

namespace App\Entity;

use App\Repository\PetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PetRepository::class)]
#[ORM\Index(name: 'pet_name_index', columns: ['name'])]
#[ORM\Index(name: 'pet_breed_index', columns: ['breed'])]
#[ORM\Index(name: 'pet_age_index', columns: ['age'])]
#[ORM\Index(name: 'pet_birthday_index', columns: ['birthday'])]
#[ORM\Index(name: 'pet_gender_index', columns: ['gender'])]
class Pet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: "Breed", inversedBy: "id")]
    #[ORM\JoinColumn(name: "breed", referencedColumnName: "id", nullable: true, onDelete: "CASCADE")]
    private ?Breed $breed = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $breedMix = null;

    #[ORM\Column(length: 128)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $age = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(columnDefinition: "enum('male', 'female')")]
    private ?string $gender = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): static
    {
        $this->breed = $breed;

        return $this;
    }

    public function getBreedMix(): ?string
    {
        return $this->breedMix;
    }

    public function setBreedMix(?string $breedMix): void
    {
        $this->breedMix = $breedMix;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAsArray(): ?array
    {
        return [
            'id' => $this->id,
            'breed' => $this->breed?->getName(),
            'breedMix' => $this->breedMix,
            'name' => $this->name,
            'age' => $this->age,
            'birthday' => $this->birthday?->format('Y-m-d'),
            'gender' => ucfirst($this->gender),
            'isDangerous' => $this->breed?->isIsDangerous(),
        ];
    }
}
