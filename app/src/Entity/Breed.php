<?php

namespace App\Entity;

use App\Repository\BreedRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BreedRepository::class)]
#[ORM\UniqueConstraint(name: 'breed_name_uindex', columns: ['name'])]
class Breed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::SMALLINT)]
    #[ORM\OneToMany(targetEntity: "Pet", mappedBy: "pet")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: "PetType", inversedBy: "id")]
    #[ORM\JoinColumn(name: "pet_type", referencedColumnName: "id", onDelete: "CASCADE")]
    private ?PetType $pet_type = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $is_dangerous = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getPetType(): ?PetType
    {
        return $this->pet_type;
    }

    public function setPetType(PetType $pet_type): static
    {
        $this->pet_type = $pet_type;

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

    public function isIsDangerous(): ?bool
    {
        return $this->is_dangerous;
    }

    public function setIsDangerous(bool $is_dangerous): static
    {
        $this->is_dangerous = $is_dangerous;

        return $this;
    }
}
