<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\HTTPException;
use App\Core\Model;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\Users;

class UsersController extends AControllerBase
{
    public function index(): Response //add
    {
        $errors = [];
        $formData = $this->request()->getPost();
        // Formular bol odoslany
        if ($formData != []) {
            // Validacia
            $users=Users::getAll();
            foreach ($users as $user){
                if($formData['name'] == $user->getName()){
                    $errors[] = "Username already exists!";
                }
            }
            if ($formData['password'] != $formData['verify_password']) {
                $errors[] = "Password and Verify password must be the same!";
            }

            // Ak nemame chyby
            if ($errors == []) {
                $user = new Users();
                $user->setName($formData['name']);
                $user->setPassword(password_hash($formData['password'], PASSWORD_DEFAULT));
                $user->setRola('p');
                $user->save();
                return $this->redirect(\App\Config\Configuration::LOGIN_URL);
            }
        }

        return $this->html(["errors" => $errors, "formData" => $formData], "index");
    }
    public function getUser(): Response
    {
        $user=$this->request()->getValue('user');
        $users = Users::getAll(" name LIKE ? ", [
            $user,
        ]);
        if ($users != null){
           $result = false;
        }else{
            $result=true;
        }
        return $this->json($result);
    }
}