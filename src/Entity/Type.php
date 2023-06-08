<?php

namespace App\Entity;


use App\Repository\TypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'type')]
#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

     public function getName(): ?string
     {
         return $this->name;
     }

     public function setName(string $name): self
     {
         $this->name = $name;

         return $this;
     }
}
