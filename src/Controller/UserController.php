<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\CustomerRepository;
use App\Repository\ItemRepository;
use App\Repository\SupplierRepository;
use App\Repository\UserRepository;
use App\View\View;

class UserController
{
    private $UserRepo;
    private $CustomerRepo;
    private $SupplierRepo;

    function __construct()
    {
        $this->UserRepo = new UserRepository();
        $this->CustomerRepo = new CustomerRepository();
        $this->SupplierRepo = new SupplierRepository();
    }

    /* Unsecured Views */
    public function index()
    {
        $this->home();
    }

    public function login()
    {
        $view = new View('user/login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function register()
    {
        $view = new View('user/register');
        $view->title = 'Register';
        $view->heading = 'Register';
        $view->display();
    }

    /* Secured Views */
    public function home()
    {
        Authentication::restrictAuthenticated();

        $customers = $this->CustomerRepo->countCustomers($_SESSION['userID'])->number;
        $items = $this->SupplierRepo->countSuppliers($_SESSION["userID"])->number;

        $view = new View('user/home');
        $view->title = 'Home';
        $view->heading = 'Hey ' . htmlentities($this->UserRepo->readById($_SESSION['userID'])->username) . '!';
        $view->customers = $customers;
        $view->items = $items;
        $view->display();
    }

    public function profile()
    {
        Authentication::restrictAuthenticated();

        $view = new View('user/profile');
        $view->title = 'Userprofile';
        $view->heading = 'Userprofile';
        $view->user = $this->UserRepo->readById($_SESSION['userID']);
        $view->display();
    }

    /* Functions */
    public function doLogin()
    {
        if (is_string($_POST['usernameInput']) && is_string($_POST['passwordInput'])) {
            if (Authentication::login($_POST['usernameInput'], $_POST['passwordInput'])) {
                header('Location: /');
            } else {
                header('Location: /default/error?errorid=9&target=/user/login');
            }
        } else {
            header('Location: /default/error?errorid=1&target=/user/login');
        }
    }

    public function doLogout()
    {
        Authentication::logout();
        header('Location: /');
    }

    public function doCreate()
    {
        if (is_string($_POST['usernameInput']) && is_string($_POST['emailInput']) && is_string($_POST['passwordInput']) && is_string($_POST["companyNameInput"]) && is_string($_POST["streetAndNumberInput"]) && is_string($_POST["zipInput"]) && is_string($_POST["cityInput"])) {
            if (preg_match("/[^\' \']+/m", $_POST['usernameInput'])) {
                $userBase = $this->UserRepo->readByUsername($_POST['usernameInput']);
                if ($userBase == null) {
                    if (filter_var($_POST['emailInput'], FILTER_VALIDATE_EMAIL)) {
                        if (preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/m', $_POST['passwordInput'])) {
                            if ($_POST['passwordInput'] === $_POST['passwordRepeatInput']) {
                                $this->UserRepo->create($_POST['usernameInput'], $_POST['emailInput'], $_POST['passwordInput'], $_POST["companyNameInput"], $_POST["streetAndNumberInput"], $_POST["zipInput"], $_POST["cityInput"]);
                                header('Location: /');
                            } else {
                                header('Location: /default/error?errorid=8&target=/user/register');
                            }
                        } else {
                            header('Location: /default/error?errorid=6&target=/user/register');
                        }
                    } else {
                        header('Location: /default/error?errorid=5&target=/user/register');
                    }
                } else {
                    header('Location: /default/error?errorid=4&target=/user/register');
                }
            } else {
                header('Location: /default/error?errorid=2&target=/user/register');
            }
        } else {
            header('Location: /default/error?errorid=1&target=/user/register');
        }
    }

    public function doDelete()
    {
        Authentication::restrictAuthenticated();

        if (is_string($_POST['passwordInput'])) {
            $user = $this->UserRepo->readById($_SESSION['userID']);
            if (Authentication::login($user->username, $_POST['passwordInput'])) {
                $this->UserRepo->deleteById($_SESSION['userID']);
                Authentication::logout();
                header('Location: /');
            } else {
                header('Location: /default/error?errorid=7&target=/user/settings');
            }
        } else {
            header('Location: /default/error?errorid=1&target=/user/settings');
        }
    }

    public function doChangeMail()
    {
        Authentication::restrictAuthenticated();

        if (is_string($_POST['passwordInput']) && is_string($_POST['emailInput'])) {
            $user = $this->UserRepo->readById($_SESSION['userID']);
            if (Authentication::login($user->username, $_POST['passwordInput'])) {
                if (filter_var($_POST['emailInput'], FILTER_VALIDATE_EMAIL)) {
                    $this->UserRepo->updateMail($_POST['emailInput'], $_SESSION['userID']);
                    header('Location: /user/settings');
                } else {
                    header('Location: /default/error?errorid=5&target=/user/settings');
                }
            } else {
                header('Location: /default/error?errorid=7&target=/user/settings');
            }
        } else {
            header('Location: /default/error?errorid=1&target=/user/settings');
        }
    }

    public function doChangePassword()
    {
        Authentication::restrictAuthenticated();

        if (is_string($_POST['passwordInput']) && is_string($_POST['passwordInput']) && is_string($_POST['passwordRepeatInput'])) {
            $user = $this->UserRepo->readById($_SESSION['userID']);
            if (Authentication::login($user->username, $_POST['passwordInput'])) {
                if (preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/m', $_POST['passwordInput'])) {
                    if ($_POST['passwordInputNew'] == $_POST['passwordRepeatInput']) {
                        $this->UserRepo->updatePassword($_POST['passwordInputNew'], $_SESSION['userID']);
                        Authentication::logout();
                        header('Location: /');
                    } else {
                        header('Location: /default/error?errorid=8&target=/user/settings');
                    }
                } else {
                    header('Location: /default/error?errorid=6&target=/user/settings');
                }
            } else {
                header('Location: /default/error?errorid=7&target=/user/settings');
            }
        } else {
            header('Location: /default/error?errorid=1&target=/user/settings');
        }
    }

    public function doCheckUsernameAvailable()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $name = $this->UserRepo->readByUsername($data->Username);
        if ($name == null) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
}
