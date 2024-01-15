<?php
namespace App\Auth;
use App\Models\Users;
use Couchbase\User;

class SimpleAuthenticator extends DummyAuthenticator {

    public function  login($login, $password): bool
    {
        $users = Users::getAll();
        $user = null;
        foreach ($users as $u){
           if ($u->getName() == $login) {
               $user = $u;
           }
        }
        if($user != null){
            $hash = $user->getPassword();
            if (password_verify($password, $hash)) {
                $_SESSION['user'] = $login;
                return true;
            }else{
                return false;
            }
        }
        else {
            return false;
        }
    }

}