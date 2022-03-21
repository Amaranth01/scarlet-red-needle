<?php

use App\Controller\AbstractController;
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

    /**
     * Display a specific user information.
     * @param int $id
     * @return void
     */
    public function showUser(int $id)
    {
        if (!UserManager::userExists($id)) {
            $this->index();
        } else {
            $this->render('user/show-user', [
                'user' => UserManager::getUser($id),
            ]);
        }
    }

    public function connexion()
    {
        self::redirectIfConnected();

        if($this->isFormSubmitted()) {
            $errorMessage = "L'utilisateur ou le mot de passe contient une erreur";
            $mail = $this->clean($this->getFormField('email'));
            $password = $this->getFormField('password');
            $username = $this->getFormField('username');

            if (empty($mail) || empty($password) || empty($username)) {
                $_SESSION['errors'][] = $errorMessage;
                $this->render('home/index');
                exit();
            }
            $user = UserManager::getUserByMail($mail);
            if (null === $user) {
                $_SESSION['errors'][] = $errorMessage;
            }
            else {
                if (password_verify($password, $user->getPassword())) {
                    $user->setPassword('');
                    $_SESSION['user'] = $user;
                }
                else {
                    $_SESSION['errors'][] = $errorMessage;
                }
            }
        }

        $this->render('admin/space-admin');
    }

}