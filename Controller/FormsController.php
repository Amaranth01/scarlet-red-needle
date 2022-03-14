<?php

class FormsController
{
    public function index()
    {
        $this->render('forms/forms-user');
    }

    public function addForm () {
        if (isset($_POST['envoyer'])) {
            echo 'le formulaire a été envoyé';
        }
    }
}