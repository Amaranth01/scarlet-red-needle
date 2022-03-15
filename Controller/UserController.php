<?php

use App\Model\Manager\UserManager;

class UserController extends AbstractController
{

    public function index()
    {
        $this->render('user/users-list', [
            'users_list' => UserManager::getAll()
        ]);
    }

    /**
     * Route handling users deletion.
     * @param int $id
     * @return void
     */
    public function deleteUser(int $id)
    {
        if(UserManager::userExists($id)) {
            $user = UserManager::getUser($id);
            $deleted = UserManager::deleteUser($user);
        }
        $this->index();
    }
}