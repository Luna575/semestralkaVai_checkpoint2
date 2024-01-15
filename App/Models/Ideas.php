<?php

namespace App\Models;

use App\Core\Model;
use MongoDB\BSON\Timestamp;

class Ideas extends Model
{
    protected ?int $id = null;
    protected ?string $text = "";
    protected string $picture = "";
    protected  string $date;
    protected string $title = "";
    protected string $user = "";

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser(string $user): void
    {
        $this->user = $user;
    }
    protected string $type ="";
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }


    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(): void
    {
        $this->date = date("Y-m-d h:m:s",time());
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
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

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }


}