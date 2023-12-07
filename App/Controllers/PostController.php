<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\HTTPException;
use App\Core\Model;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Post;
use http\Exception;
use PDO;

class PostController extends AControllerBase
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->redirect($this->url("home.index"));
    }

    public function add(): Response
    {
        $errors = [];
        $formData = $this->request()->getPost();
        // Formular bol odoslany
        if ($formData != []) {
            // Validacia
            if (empty($formData['text'])) {
                $errors[] = "Pole 'text' musi byt vyplnene";
            }
            if (empty($formData['picture'])) {
                $errors[] = "Pole 'picture' musi byt vyplnene";
            }
            if (!filter_var($formData['picture'], FILTER_VALIDATE_URL)) {
                $errors[] = "Pole 'picture' musi byt url adresa";
            }

            // Ak nemame chyby
            if ($errors == []) {
                $post = new Post();
                $post->setText($formData['text']);
                $post->setPicture($formData['picture']);
                $post->save();
                return $this->redirect($this->url("home.index"));
            }
        }

        return $this->html(["errors" => $errors, "formData" => $formData], "form");
    }


    public function edit(): Response
    {
        $id = (int) $this->request()->getValue('id');
        $post = Post::getOne($id);

        if (is_null($post)) {
            throw new HTTPException(404);
        }

        return $this->html(
            [
                'post' => $post
            ]
        );
    }

    public function save()
    {
        $id = (int)$this->request()->getValue('id');
        $oldFileName = "";

        if ($id > 0) {
            $post = Post::getOne($id);
            $oldFileName = $post->getPicture();
        } else {
            $post = new Post();
        }
        $post->setText($this->request()->getValue('text'));
        $post->setPicture($this->request()->getFiles()['picture']['name']);

        $formErrors = $this->formErrors();
        if (count($formErrors) > 0) {
            return $this->html(
                [
                    'post' => $post,
                    'errors' => $formErrors
                ], 'add'
            );
        } else {
            if ($oldFileName != "") {
                FileStorage::deleteFile($oldFileName);
            }
            $newFileName = FileStorage::saveFile($this->request()->getFiles()['picture']);
            $post->setPicture($newFileName);
            $post->save();
            return new RedirectResponse($this->url("home.index"));
        }
    }

    public function delete()
    {
        $id = (int) $this->request()->getValue('id');
        $post = Post::getOne($id);

        if (is_null($post)) {
            throw new HTTPException(404);
        } else {
            FileStorage::deleteFile($post->getPicture());
            $post->delete();
            return new RedirectResponse($this->url("home.index"));
        }
    }

    private function formErrors(): array
    {
        $errors = [];
        if ($this->request()->getFiles()['picture']['name'] == "") {
            $errors[] = "Pole Súbor obrázka musí byť vyplnené!";
        }
        if ($this->request()->getValue('text') == "") {
            $errors[] = "Pole Text príspevku musí byť vyplnené!";
        }
        if ($this->request()->getFiles()['picture']['name'] != "" && !in_array($this->request()->getFiles()['picture']['type'], ['image/jpeg', 'image/png'])) {
            $errors[] = "Obrázok musí byť typu JPG alebo PNG!";
        }
        if ($this->request()->getValue('text') != "" && strlen($this->request()->getValue('text') < 5)) {
            $errors[] = "Počet znakov v text príspevku musí byť viac ako 5!";
        }
        return $errors;
    }
}