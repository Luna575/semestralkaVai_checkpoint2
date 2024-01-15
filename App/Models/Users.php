<?php

namespace App\Models;

use App\Core\Model;

class Users extends Model
{
    protected ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    protected string $name;
    protected string $password;
    protected string $rola;
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $login): void
    {
        $this->password = $login;
    }

    public function getRola(): string
    {
        return $this->rola;
    }

    public function setRola(string $char): void
    {
        $this->rola = $char;
    }


}