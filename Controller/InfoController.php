<?php

use App\Controller\AbstractController;
use App\Model\Manager\InfoManager;

class InfoController extends AbstractController
{

    public function index()
    {
    }

    /**
     * @param $id
     */
    public function editInfo($id)
    {
        if(!self::userConnected() || !self::adminConnected()) {
            $_SESSION['errors'] = "Seul un tatoueur peut être modifier le message d'accueil";
            $this->render('home/index', $data);
            exit();
        }

        if(!isset($_POST['content'])) {
            $_SESSION['errors'] = "Merci de remplir le champ";
            $this->render('admin/space-admin');
            exit();
        }

        $newContent = $this->clean($_POST['content']);

        $info = new InfoManager($newContent, $id);
        $info->editInfo($newContent, $id);

        $this->render('admin/space-admin');
        exit();
    }


}