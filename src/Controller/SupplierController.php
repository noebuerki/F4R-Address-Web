<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\CustomerRepository;
use App\Repository\ItemRepository;
use App\Repository\SupplierRepository;
use App\Repository\ValuationRepository;
use App\View\View;

class SupplierController
{

    private $SupplierRepo;

    function __construct()
    {
        $this->SupplierRepo = new SupplierRepository();
    }

    /* Unsecured Views */
    public function index()
    {
        $this->search();
    }

    /* Secured Views */
    public function create()
    {
        Authentication::restrictAuthenticated();

            $view = new View('supplier/create');
            $view->title = 'Add supplier';
            $view->heading = 'Add supplier';
            $view->display();
    }

    public function update()
    {
        Authentication::restrictAuthenticated();

        if (is_numeric($_GET["itemId"])) {
            $item = $this->ItemRepo->readByID($_SESSION["userID"], $_GET["itemId"]);
            if ($item != null) {
                $view = new View('supplier/update');
                $view->title = 'Update supplier';
                $view->heading = 'Update supplier';
                $view->item = $item;
                $view->display();
            } else {
                header('Location: /default/error?errorid=1&target=/item/');
            }
        } else {
            header('Location: /default/error?errorid=1&target=/item/');
        }
    }

    /* Functions */
    public function doCreate()
    {
        Authentication::restrictAuthenticated();

        if (is_string($_POST["companyInput"]) && is_string($_POST["firstNameInput"]) && is_string($_POST["lastNameInput"]) && is_string($_POST["streetInput"]) && is_string($_POST["houseNumberInput"]) && is_string($_POST["zipInput"]) && is_string($_POST["cityInput"])) {
            $this->SupplierRepo->create($_SESSION["userID"], $_POST["companyInput"], $_POST["firstNameInput"], $_POST["lastNameInput"], $_POST["streetInput"], $_POST["houseNumberInput"], $_POST["zipInput"], $_POST["cityInput"]);
            header("Location: /item/overview?customerId={$_POST["customerIdInput"]}");
        } else {
            header('Location: /default/error?errorid=1&target=/item/');
        }
    }

    public function doUpdate()
    {
        Authentication::restrictAuthenticated();

        if (is_numeric($_POST["supplierIdInput"]) && is_string($_POST["companyInput"]) && is_string($_POST["firstNameInput"]) && is_string($_POST["lastNameInput"]) && is_string($_POST["streetInput"]) && is_string($_POST["houseNumberInput"]) && is_string($_POST["zipInput"]) && is_string($_POST["cityInput"])) {
            $item = $this->SupplierRepo->readByID($_SESSION["userID"], $_POST["itemIdInput"]);
            if ($item != null) {
                $this->SupplierRepo->update($_SESSION["userID"], $_POST["supplierIdInput"], $_POST["companyInput"], $_POST["firstNameInput"], $_POST["lastNameInput"], $_POST["streetInput"], $_POST["houseNumberInput"], $_POST["zipInput"], $_POST["cityInput"]);
                $target = 'Location: /item/overview?customerId=' . $item->customerId;
                header($target);
            } else {
                header('Location: /default/error?errorid=1&target=/item/');
            }
        } else {
            header('Location: /default/error?errorid=1&target=/item/');
        }
    }

    public function doDelete() {
        Authentication::restrictAuthenticated();

        if (is_numeric($_GET["itemId"])) {
            $item = $this->ItemRepo->readByID($_SESSION["userID"], $_GET["itemId"]);
            if ($item != null) {
                $this->ItemRepo->deleteById($_SESSION["userID"], $_GET["itemId"]);
                $target = 'Location: /item/overview?customerId=' . $item->customerId;
                header($target);
            } else {
                header('Location: /default/error?errorid=1&target=/item/');
            }

        } else {
            header('Location: /default/error?errorid=1&target=/item/');
        }
    }
}
