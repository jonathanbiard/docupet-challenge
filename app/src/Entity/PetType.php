<?php

namespace App\Entity;

use App\Repository\PetTypeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PetTypeRepository::class)]
#[ORM\UniqueConstraint(name: 'pet_type_name_uindex', columns: ['name'])]
class PetType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::SMALLINT)]
    #[ORM\OneToMany(targetEntity: "Breed", mappedBy: "breed")]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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
}
