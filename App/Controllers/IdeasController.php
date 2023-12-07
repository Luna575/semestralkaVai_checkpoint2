<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Post;

class IdeasController extends AControllerBase
{


   public function index(): Response
    {
        return $this->html([
            'posts' => Post::getAll()
        ]);
    }
}