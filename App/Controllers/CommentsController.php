<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Comments;


class CommentsController extends AControllerBase
{

    public function index(): Response
    {
        throw new HTTPException(404);
    }




    public function add(): Response
    {
        $errors = [];
        $formData = $this->request()->getPost();
        $idea = (int) $this->request()->getValue('idea');
        // Formular bol odoslany
        if ($formData != []) {

            if (empty($formData['text'])) {
                $errors[] = "The field Text of the idea must be filled!";
            }

            // Ak nemame chyby
            if ($errors == []) {
                $comments = new Comments();
                $comments->setText($formData['text']);
                $comments->setDate();
                $comments->setIdea($idea);
                $comments->setUser($formData['user']);
                $comments->save();
                return $this->redirect($this->url("ideas.view", ['id' => $comments->getIdea()]));
            }
        }

        return $this->html(["errors" => $errors, "formData" => $formData, "idea" => $idea], "add");
    }


    public function edit(): Response
    {
        $id = (int) $this->request()->getValue('id');
        $comments = Comments::getOne($id);

        if (is_null($comments)) {
            throw new HTTPException(404);
        }

        return $this->html(
            [
                'comments' => $comments,
                'idea' => null
            ]
        );
    }


    public function save()
    {
        $id = (int)$this->request()->getValue('id');
        $oldFileName = "";

        if ($id > 0) {
            $comments = Comments::getOne($id);
        } else {
            $comments = new Comments();
        }
        $comments->setText($this->request()->getValue('text'));
        $comments->setDate();
        $comments->setIdea($this->request()->getValue('idea'));
        $comments->setUser($this->request()->getValue('user'));
        $formErrors = $this->formErrors();
        if (count($formErrors) > 0) {
            return $this->html(
                [
                    'comments' => $comments,
                    'errors' => $formErrors
                ], 'error'
            );
        } else {
            $comments->save();
            return new RedirectResponse($this->url("ideas.view", ['id' => $comments->getIdea()]));
        }
    }

    public function delete()
    {
        $id = (int) $this->request()->getValue('id');
        $comments = Comments::getOne($id);

        if (is_null($comments)) {
            throw new HTTPException(404);
        } else {
            $idea =$comments->getIdea();
            $comments->delete();
            return new RedirectResponse($this->url("ideas.view", ['id' => $idea]));
        }
    }

    private function formErrors(): array
    {
        $errors = [];


        if ($this->request()->getValue('text') == "") {
            $errors[] = "The field Text of the idea must be filled!";
        }
        return $errors;
    }
}