<?php

use App\Controller\AbstractController;
use App\Model\Entity\User;
use App\Model\Manager\RoleManager;
use App\Model\Manager\UserManager;

class UserController extends AbstractController
{

    public function index()
    {
        $this->render('admin/user-list', [
            'user-list' => UserManager::getAll()
        ]);
    }

    /**
     * @return void
     */
    public function register()
    {

        //self::redirectIfConnected();

        if($this->isFormSubmitted()) {
            $mail = $this->clean($this->getFormField('email'));
            $username = $this->clean($this->getFormField('username'));
            $password = $this->getFormField('password');
            $passwordRepeat = $this->getFormField('password-repeat');

            $errors = [];
            $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                // l'email n'est pas valide.
                $errors[] = "L'adresse mail n'est pas au bon format";
            }

            if(!strlen($username) >= 2) {
                // Le firstname ne fait pas au moins 2 caractères.
                $errors[] = "Le pseudo doit faire au moins deux caractères";
            }

            if($password !== $passwordRepeat) {
                // Les passwords ne correspondent pas !
                $errors[] = "Les password ne correspondent pas";
            }

            if(!preg_match('/^(?=.*[!@#$%^&*-\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
                // Le password ne correspond pas au critère.
                $errors[] = "Le password ne correpsond pas au critère";
            }

            // S'il y a une erreur, enregistrement des messages en session.
            if(count($errors) > 0) {
                $_SESSION['errors'] = $errors;
            }
            else {
                // C'est ok, pas d'erreurs, enregistrement.
                $user = new User();
                $role = RoleManager::getRoleByName('user');
                $user
                    ->setUsername($username)
                    ->setEmail($mail)
                    ->setPassword(password_hash($password, PASSWORD_DEFAULT))
                    ->setRole($role)
                ;

                if(0 == UserManager::userMailExists($user->getEmail())['count(*)']) {
                    UserManager::addUser($user);

                    if(null !== $user->getId()) {
                        $_SESSION['success'] = "Félicitations votre compte est actif";
                        $user->setPassword('');
                        $_SESSION['user'] = $user;
                    }
                    else {
                        $_SESSION['errors'] = ["Impossible de vous enregistrer"];
                    }
                }
                else {
                    $_SESSION['errors'] = ["Cette adresse mail existe déjà !"];
                }
            }

        }
        $this->render('admin/space-admin');
    }

    /**
     * Delete users
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

        $this->render('user/space-admin');
    }

}