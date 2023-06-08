<?php

namespace App\Entity;

use App\Repository\MovieHasPeopleRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'movie_has_people')]
#[ORM\Entity(repositoryClass: MovieHasPeopleRepository::class)]
class MovieHasPeople
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Movie::class)]
    #[ORM\JoinColumn(name: 'Movie_id')]
    private ?\App\Entity\Movie $movie = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:  People::class)]
    #[ORM\JoinColumn(name: 'People_id')]
    private ?\App\Entity\People $people = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private ?string $role = null;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255, nullable: true)]
    private ?string $significance = null;

    public function setMovie(Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setPeople(People $people): self
    {
        $this->people = $people;

        return $this;
    }

    public function getPeople(): ?People
    {
        return $this->people;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getSignificance(): string
    {
        return $this->significance;
    }

    public function setSignificance(string $significance): self
    {
        $this->significance = $significance;

        return $this;
    }
}
