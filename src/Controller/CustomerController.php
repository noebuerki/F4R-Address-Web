<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\CustomerRepository;
use App\View\View;

class CustomerController
{

    private $CustomerRepo;

    function __construct()
    {
        $this->CustomerRepo = new CustomerRepository();
    }

    /* Unsecured Views */
    public function index()
    {
        $this->search();
    }

    /* Secured Views */
    public function search()
    {
        Authentication::restrictAuthenticated();

        $view = new View('customer/search');
        $view->title = 'Search customer';
        $view->heading = 'Search customer';
        $view->firstName = (isset($_GET["firstName"])) ? $_GET["firstName"] : "";
        $view->lastName = (isset($_GET["lastName"])) ? $_GET["lastName"] : "";
        $view->display();
    }

    public function select()
    {
        Authentication::restrictAuthenticated();

        if (is_string($_GET["firstName"]) && is_string($_GET["lastName"])) {
            $view = new View('customer/select');
            $view->title = 'Select customer';
            $view->heading = 'Select customer';
            $view->firstName = $_GET["firstName"];
            $view->lastName = $_GET["lastName"];
            $view->customers = $this->CustomerRepo->readByName($_SESSION["userID"], $_GET["firstName"], $_GET["lastName"]);
            $view->display();
        } else {
            header('Location: /default/error?errorid=1&target=/customer/');
        }
    }

    /* Functions */
    public function doSearch()
    {
        Authentication::restrictAuthenticated();

        if (is_string($_POST["firstNameInput"]) || is_string($_POST["lastNameInput"])) {
            $customers = $this->CustomerRepo->readByName($_SESSION["userID"], $_POST["firstNameInput"], $_POST["lastNameInput"]);
            if ($customers != null) {
                header("Location: /customer/select?firstName={$_POST["firstNameInput"]}&lastName={$_POST["lastNameInput"]}");
            } else {
                header("Location: /customer/search?firstName={$_POST["firstNameInput"]}&lastName={$_POST["lastNameInput"]}");
            }
        } else {
            header('Location: /default/error?errorid=1&target=/customer/add');
        }
    }
}
