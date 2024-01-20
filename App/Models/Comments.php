<?php

namespace App\Models;

use App\Core\Model;
date_default_timezone_set('Europe/Bratislava');
class Comments extends Model
{
    protected ?int $id = null;
    protected string $text = "";
    protected string $user;
    protected  string $date;

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(): void
    {
        $this->date = date("Y-m-d H:i:s",time());
    }
    protected int $idea;

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

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    public function getIdea(): int
    {
        return $this->idea;
    }

    public function setIdea(int $idea): void
    {
        $this->idea = $idea;
    }
}