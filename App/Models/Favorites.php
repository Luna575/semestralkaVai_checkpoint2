<?php

namespace App\Models;

use App\Core\Model;

class Favorites extends Model
{
    protected int $id;
    protected string $name;
    protected int $idea;

    public function getIdea(): int
    {
        return $this->idea;
    }

    public function setIdea(int $idea): void
    {
        $this->idea = $idea;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}