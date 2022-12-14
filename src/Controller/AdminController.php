<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\CustomerRepository;
use App\Repository\UserRepository;
use App\View\View;

class AdminController
{

    private $UserRepo;
    private $CustomerRepo;
    private $ItemRepo;

    function __construct()
    {
        $this->UserRepo = new UserRepository();
        $this->CustomerRepo = new CustomerRepository();
        $this->ItemRepo = new ItemRepository();
    }

    /* Secured Views */
    public function index()
    {
        $this->overview();
    }

    public function overview()
    {
        Authentication::restrictAdmin();

        $view = new View('admin/overview');
        $view->title = '🍌';
        $view->heading = 'Admin-Panel';
        $view->UserCount = $this->UserRepo->countUsers()->number;
        $view->CustomerCount = $this->CustomerRepo->countCustomers()->number;
        $view->ItemCount = $this->ItemRepo->countItems()->number;
        $view->display();
    }

    public function usermanager()
    {
        Authentication::restrictAdmin();

        $view = new View('admin/usermanager');
        $view->title = 'Benutzerverwaltung';
        $view->heading = 'Benutzer verwalten';
        $view->display();
    }

    /* Funktionen */
    public function doChangePassword()
    {
        Authentication::restrictAdmin();

        if (is_string($_POST['usernameInputPW']) && is_string($_POST['passwordInputNew']) && is_string($_POST['passwordRepeatInput'])) {
            $user = $this->UserRepo->readByUsername($_POST['usernameInputPW']);
            if ($user != null) {
                if (preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/m', $_POST['passwordInputNew'])) {
                    if ($_POST['passwordInputNew'] == $_POST['passwordRepeatInput']) {
                        $this->UserRepo->updatePassword($_POST['passwordInputNew'], $user->id);
                        header('Location: /admin/usermanager');
                    } else {
                        header('Location: /default/error?errorid=8&target=/admin/usermanager');
                    }
                } else {
                    header('Location: /default/error?errorid=6&target=/admin/usermanager');
                }
            } else {
                header('Location: /default/error?errorid=3&target=/admin/usermanager');
            }
        } else {
            header('Location: /default/error?errorid=1&target=/admin');
        }
    }

    public function doRemoveUser()
    {
        Authentication::restrictAdmin();

        if (is_string($_POST['usernameInputRemove'])) {
            $user = $this->UserRepo->readByUsername($_POST['usernameInputRemove']);
            if ($user != null) {
                $this->UserRepo->deleteById($user->id);
                header('Location: /admin/usermanager');
            } else {
                header('Location: /default/error?errorid=3&target=/admin/usermanager');
            }
        } else {
            header('Location: /default/error?errorid=1&target=/admin');
        }
    }
}
