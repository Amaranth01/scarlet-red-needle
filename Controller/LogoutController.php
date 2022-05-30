<?php

namespace App\Controller;

class LogoutController extends AbstractController
{

    function index()
    {
        $this->render('home/index');
    }

    function logout()
    {
        //Destroy all sessions data
        $_SESSION = array();

        //Destroy browser cookie sessions
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 60000, $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]);
        //Destroy the session
        session_destroy();
        //Redirecting to home page
        self::index();
        //Send a success message
        $_SESSION['success'] = "Vous êtes déconnecté";
    }
}