<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'movie_has_type')]
#[ORM\Entity]
class MovieHasType
{

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Movie::class)]
    #[ORM\JoinColumn(name: 'Movie_id')]
    private $movie;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:  Type::class)]
    #[ORM\JoinColumn(name: 'Type_id')]
    private $type;

    public function setMovie(Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setType(Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }
}
