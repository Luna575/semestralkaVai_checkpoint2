<?php

namespace App\Models;

use App\Core\Model;

class Theme extends Model
{
    protected ?int $id = null;
    protected string $text = "";
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

}