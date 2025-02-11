<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\HTTPException;
use App\Core\Model;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Comments;
use App\Models\Favorites;
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
        $s= $this->request()->getValue('s');
        return  $this->html([
            'ideas' => Ideas::getAll(orderBy: '`date` desc'),
            's' => $s
        ]);
    }




    public function add(): Response
    {
        $errors = [];
        $formData = $this->request()->getPost();
        // Formular bol odoslany
        if ($formData != []) {
            // Validacia
            if (empty($formData['picture'])) {
                $errors[] = "Image file field must be filled!";
            }
            if ($formData['picture']['name'] != "" && !in_array($formData['picture']['type'], ['image/jpeg', 'image/png'])) {
                $errors[] = "The image must be of JPG or PNG type!";
            }
            if ($formData['picture']['name'] != "" && strlen($formData['picture']['name'])>300) {
                $errors[] = "Image file name is to long, max length is 300 characters!";
            }
            if (empty($formData['title'])) {
                $errors[] = "The field Title of the idea must be filled!";
            }
            if (empty($formData['type'])) {
                $errors[] = "The field Type of the idea must be filled!";
            }
            if (!empty($formData['title'])  && strlen($formData['title']) > 30) {
                $errors[] = "The number of characters in the title of the idea  must be max 30 characters!";
            }
            if ($formData['type'] != "" && strlen($formData['type']) > 1) {
                $errors[] = "The number of characters in the idea post type must be 1!";
            }
            if (empty($formData['user'])) {
                $errors[] = "You need to be logged!";
            }

            // Ak nemame chyby
            if ($errors == []) {
                $ideas = new Ideas();
                $ideas->setText($formData['text']);
                $ideas->setPicture($formData['picture']);
                $ideas->setDate();
                $ideas->setTitle($formData['title']);
                $ideas->setType($formData['type']);
                $ideas->setUser($formData['user']);
                $ideas->save();
                return $this->redirect($this->url("ideas.index"));
            }
        }
        $s = "";
        $path= "ideas.index";
        return $this->html(["errors" => $errors, "formData" => $formData, "path"=>$path, "s"=>$s], "add");
    }


    public function edit(): Response
    {
        $id = (int) $this->request()->getValue('id');
        $s = $this->request()->getValue('s') != null ? $this->request()->getValue('s'):"";
        $path= (string)$this->request()->getValue('path') != null ? $this->request()->getValue('path'):"ideas.index";
        $ideas = Ideas::getOne($id);

        if (is_null($ideas)) {
            throw new HTTPException(404);
        }

        return $this->html(
            [
                'ideas' => $ideas,
                'path'=>$path,
                's'=>$s
            ]
        );
    }
    public function view(): Response
    {
        $id = (int) $this->request()->getValue('id');
        $ideas = Ideas::getOne($id);

        if (is_null($ideas)) {
            throw new HTTPException(404);
        }

        return $this->html(
            [
                'ideas' => $ideas,
                'comments' => Comments::getAll('`idea` LIKE ?', [$id],orderBy: '`date` desc')
            ]
        );
    }

    public function save()
    {
        $id = (int)$this->request()->getValue('id');
        $s = $this->request()->getValue('s') != null ? $this->request()->getValue('s'):"";
        $path= (string)$this->request()->getValue('path');
        $oldFileName = "";

        if ($id > 0) {
            $ideas = Ideas::getOne($id);
            $oldFileName = $ideas->getPicture();
        } else {
            $ideas = new Ideas();
        }
        $ideas->setText($this->request()->getValue('text'));
        $ideas->setType($this->request()->getValue('type'));
        $ideas->setTitle($this->request()->getValue('title'));
        $ideas->setDate();
        $ideas->setUser($this->request()->getValue('user'));
        $ideas->setPicture($this->request()->getFiles()['picture']['name']);
        if ($this->request()->getFiles()['picture']['name'] =="" &&  $id > 0) {
            $ideas->setPicture($oldFileName);
        }
        $formErrors = $this->formErrors();
        if (count($formErrors) > 0) {
            return $this->html(
                [
                    'ideas' => $ideas,
                    'errors' => $formErrors,
                    'path'=>$path,
                    's'=>$s
                ], 'error'
            );
        } else {
            if ($oldFileName != "" && $this->request()->getFiles()['picture']['name'] != "") {
                FileStorage::deleteFile($oldFileName);
            }
            if($this->request()->getFiles()['picture']['name'] != "") {
                $newFileName = FileStorage::saveFile($this->request()->getFiles()['picture']);
                $ideas->setPicture($newFileName);
            }
            $ideas->save();
            return new RedirectResponse($this->url($path,['s'=>$s]));
        }
    }

    public function delete()
    {
        $id = (int) $this->request()->getValue('id');
        $s = $this->request()->getValue('s') != null ? $this->request()->getValue('s'):"";
        $path= (string)$this->request()->getValue('path');
        $ideas = Ideas::getOne($id);

        if (is_null($ideas)) {
            throw new HTTPException(404);
        } else {
            FileStorage::deleteFile($ideas->getPicture());
            $favorites = Favorites::getAll(' `idea` LIKE ? ', [$ideas->getId()]);
            foreach ($favorites as $favorite){
                $favorite->delete();
            }
            $comments = Comments::getAll(' `idea` LIKE ? ', [$ideas->getId()]);
            foreach ($comments as $comment){
                $comment->delete();
            }
            $ideas->delete();
            return new RedirectResponse($this->url($path,['s'=>$s]));
        }
    }

    private function formErrors(): array
    {
        $errors = [];
        if ($this->request()->getFiles()['picture']['name'] == "" && $this->request()->getValue('id') < 0) {
            $errors[] = "Image file field must be filled!";
        }
        if ($this->request()->getFiles()['picture']['name'] != "" && !in_array($this->request()->getFiles()['picture']['type'], ['image/jpeg', 'image/png'])) {
            $errors[] = "The image must be of JPG or PNG type!";
        }
        if ($this->request()->getFiles()['picture']['name'] != "" && strlen($this->request()->getFiles()['picture']['name'])>300) {
            $errors[] = "Image file name is to long, max length is 300 characters!";
        }

        if ($this->request()->getValue('title') == "") {
            $errors[] = "The field Title of the idea must be filled!";
        }
        if ($this->request()->getValue('title') != "" && strlen($this->request()->getValue('title')) > 30) {
            $errors[] = "The number of characters in the title of the idea  must be max 30 characters!";
        }
        if ($this->request()->getValue('type') == "") {
            $errors[] = "The field Type of the idea must be filled!";
        }
        if ($this->request()->getValue('type') != "" && strlen($this->request()->getValue('type')) > 1) {
            $errors[] = "The number of characters in the idea post type must be 1!";
        }
        if ($this->request()->getValue('user') =="") {
            $errors[] = "You need to be logged!";
        }
        return $errors;
    }
    public function getPicture(): Response
    {
        $picture=$this->request()->getValue('picture');
        $id = $this->request()->getValue('id');
        if ($id == null) {
        $ideas = Ideas::getAll("`picture` LIKE ? ", [
            "%$picture"
        ]);
        } else {
            $ideas = Ideas::getAll("`picture` LIKE ?  AND `id` != ?", [
                "%$picture", $id
            ]);
        }
        if ($ideas != null){
            $result = false;
        }else{
            $result=true;
        }
        return $this->json($result);
    }
    public function getTitle(): Response
    {
        $title = $this->request()->getValue('title');
        $id = $this->request()->getValue('id');
        if ($id == null) {
            $ideas = Ideas::getAll("`title` LIKE ? ", [
                $title
            ]);
        } else {
            $ideas = Ideas::getAll("`title` LIKE ?  AND `id` != ?", [
                $title, $id
            ]);
        }
        if ($ideas != null){
            $result = false;
        }else{
            $result=true;
        }
        return $this->json($result);
    }
}