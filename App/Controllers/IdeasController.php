<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\HTTPException;
use App\Core\Model;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Ideas;
use http\Exception;
use PDO;

class IdeasController extends AControllerBase
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
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
            if (empty($formData['theme'])) {
                $errors[] = "Pole 'theme' musi byt vyplnene";
            }
            if (empty($formData['type'])) {
                $errors[] = "Pole 'type' musi byt vyplnene";
            }

            // Ak nemame chyby
            if ($errors == []) {
                $ideas = new Ideas();
                $ideas->setText($formData['text']);
                $ideas->setPicture($formData['picture']);
                $ideas->setDate();
                $ideas->setTheme($formData['theme']);
                $ideas->setType($formData['type']);
                $ideas->save();
                return $this->redirect($this->url("ideas.index"));
            }
        }

        return $this->html(["errors" => $errors, "formData" => $formData], "form");
    }


    public function edit(): Response
    {
        $id = (int) $this->request()->getValue('id');
        $ideas = Ideas::getOne($id);

        if (is_null($ideas)) {
            throw new HTTPException(404);
        }

        return $this->html(
            [
                'ideas' => $ideas
            ]
        );
    }

    public function save()
    {
        $id = (int)$this->request()->getValue('id');
        $oldFileName = "";

        if ($id > 0) {
            $ideas = Ideas::getOne($id);
            $oldFileName = $ideas->getPicture();
        } else {
            $ideas = new Ideas();
        }
        $ideas->setText($this->request()->getValue('text'));
        $ideas->setPicture($this->request()->getFiles()['picture']['name']);
        $ideas->setType($this->request()->getFiles()['type']);
        $ideas->setTheme($this->request()->getFiles()['theme']);
        $ideas->setDate();
        $formErrors = $this->formErrors();
        if (count($formErrors) > 0) {
            return $this->html(
                [
                    'ideas' => $ideas,
                    'errors' => $formErrors
                ], 'add'
            );
        } else {
            if ($oldFileName != "") {
                FileStorage::deleteFile($oldFileName);
            }
            $newFileName = FileStorage::saveFile($this->request()->getFiles()['picture']);
            $ideas->setPicture($newFileName);
            $ideas->save();
            return new RedirectResponse($this->url("ideas.index"));
        }
    }

    public function delete()
    {
        $id = (int) $this->request()->getValue('id');
        $ideas = Ideas::getOne($id);

        if (is_null($ideas)) {
            throw new HTTPException(404);
        } else {
            FileStorage::deleteFile($ideas->getPicture());
            $ideas->delete();
            return new RedirectResponse($this->url("ideas.index"));
        }
    }

    private function formErrors(): array
    {
        $errors = [];
        if ($this->request()->getFiles()['picture']['name'] == "") {
            $errors[] = "Image file field must be filled!";
        }

        if ($this->request()->getFiles()['picture']['name'] != "" && !in_array($this->request()->getFiles()['picture']['type'], ['image/jpeg', 'image/png'])) {
            $errors[] = "The image must be of JPG or PNG type!";
        }

        if ($this->request()->getValue('theme') == "") {
            $errors[] = "The field Theme of the idea must be filled!";
        }
        if ($this->request()->getValue('theme') != "" && strlen($this->request()->getValue('theme') < 3)) {
            $errors[] = "The number of characters in the idea post subject must be more than 3!";
        }
        if ($this->request()->getValue('type') == "") {
            $errors[] = "The field Type of the idea must be filled!";
        }
        if ($this->request()->getValue('type') != "" && strlen($this->request()->getValue('type') > 1)) {
            $errors[] = "The number of characters in the idea post type must be 1!";
        }
        return $errors;
    }
}