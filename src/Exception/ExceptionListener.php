<?php

namespace App\Exception;

use App\View\View;
use Throwable;

class ExceptionListener
{
    private function __construct()
    {
    }

    public static function register()
    {
        set_exception_handler(self::class . '::handleException');
    }

    public static function handleException(Throwable $exception)
    {
        $error = $exception->getMessage();

        if (substr($error, -9) === "not found" || substr($error, -2) === "()") {
            print($error);
            $message = "404: Page not found";
        } else {
            $message = $error;
        }

        $view = new View('error');
        $view->title = 'Fehler';
        $view->heading = '❌ Ein Fehler ist aufgetretten';
        $view->userMessage = $message;

        if ($exception instanceof DatabaseConnectionException) {
            $view->userMessage = 'Bitte kontaktieren Sie den Administrator';
        }

        $view->display();
    }
}
