<?php
namespace App\Auth;
use App\Models\Users;
use Couchbase\User;

class SimpleAuthenticator extends DummyAuthenticator {

    public function  login($login, $password): bool
    {
        $user = Users::getAll('`name` LIKE ?', [$login]);
        if($user != null){
            $hash = $user[0]->getPassword();
            if (password_verify($password, $hash)) {
                $_SESSION['user'] = $login;
                $_SESSION['rola'] = $user[0]->getRola();
                return true;
            }else{
                return false;
            }
        }
        else {
            return false;
        }

    }
    public function logout(): void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            unset($_SESSION["rola"]);
            session_destroy();
        }
    }
    public function getLoggedRola(): string
    {
        return $_SESSION['rola'] ?? throw new \Exception("Users not logged in");
    }

}