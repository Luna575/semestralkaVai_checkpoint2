<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\Favorites;
use App\Models\Ideas;

class FavoritesController extends AControllerBase
{
    public function index(): Response
    {
        return  $this->html([
            'favorites' => Favorites::getAll(orderBy: '`id` desc'),
        ]);
    }
    public function add(): Response
    {
        $user = $this->request()->getValue('user');
        $idea= (int) $this->request()->getValue('idea');
        $path= (string)$this->request()->getValue('path');
        $parameters= (array)$this->request()->getValue('par') != null ? (array)$this->request()->getValue('par'):[];
        $errors = [];
        $formData = $this->request()->getPost();
        if ($user==null) {
            $errors[] = "User was not found!";
        }
        if ($idea==null) {
            $errors[] = "Idea was not found!";
        }
            // Ak nemame chyby
        if ($errors == []) {
                $favorites = new Favorites();
                $favorites->setIdea($idea);
                $favorites->setName($user);
                $favorites->save();
        }
       return new RedirectResponse($this->url($path,$parameters));
    }
    public function delete()
    {
        $user = $this->request()->getValue('user');
        $idea = (int) $this->request()->getValue('idea');
        $path= (string)$this->request()->getValue('path');
        $parameters= (array)$this->request()->getValue('par') != null ? (array)$this->request()->getValue('par'):[];
        $favorites = Favorites::getAll('`name` LIKE ? AND `idea` LIKE ? ', [$user,$idea]);

        if ($favorites == null) {
            throw new HTTPException(404);
        } else {
            $favorites[0]->delete();
            return new RedirectResponse($this->url($path,$parameters));
        }
    }
}