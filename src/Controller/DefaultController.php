<?php

namespace App\Controller;

use App\View\View;

class DefaultController
{
    private $errorCodes = array("Ein unbekannter Fehler ist aufgetreten", "Dieser Benutzername ist ungültig", "Dieser Benutzer ist nicht vorhanden", "Dieser Benutzername ist bereits vergeben", "Diese E-Mail ist ungültig", "Dieses Passwort ist ungültig", "Das eingegebene Passwort ist falsch", "Die beiden Passwörter stimmen nicht überein", "Dein Benutzername oder Passwort ist falsch", "Du verfügst nicht über die nötigen Rechte, um diese Seite zu besuchen");

    /* Unsecured Views */
    public function index()
    {
        $controller = new UserController();
        $controller->index();
    }

    public function about()
    {
        $view = new View('default/about');
        $view->title = 'About us ❤️';
        $view->heading = 'About FuturaAddress';
        $view->display();
    }

    public function privacy()
    {
        $view = new View('default/privacy');
        $view->title = 'Privacy';
        $view->heading = 'Privacy';
        $view->display();
    }

    public function error()
    {
        if (!empty($_GET['errorid']) && is_numeric($_GET['errorid']) && !empty($_GET['target']) && is_string($_GET['target'])) {
            if (!strpos($_GET['target'], "javascript")) {
                $target = $_GET['target'];
                $view = new View('default/error');
                $view->title = 'Info';
                $view->heading = '';
                $view->message = $this->errorCodes[$_GET['errorid'] - 1];
                $view->target = $target;
                $view->display();
            } else {
                header('Location: /default/error?errorid=1&target=/');
            }
        } else {
            header('Location: /default/error?errorid=1&target=/');
        }
    }
}
