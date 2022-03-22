<?php

namespace App\Controller;

use App\Model\Entity\User;

abstract class AbstractController
{
    abstract public function index();

    /**
     * @param string $template
     * @param array $data
     * @return void
     */
    public function render(string $template, array $data = [])
    {
        ob_start();
        require __DIR__ . '/../View/' . $template . '.html.php';
        $html = ob_get_clean();
        require __DIR__ . '/../View/base.html.php';
    }

    /**
     * Clean all input against XSS attack
     * @param string $data
     * @return string
     */
    function clean(string $data): string
    {

        $data = trim($data);
        $data = strip_tags($data);
        $data = htmlentities($data);

        if ($data < 0 || $data > 100) {
            $data = 15;
        }

        return $data;
    }

    public function redirectIfNotConnected(): self
    {
        if(!self::userConnected()) {
            $this->render('home/index');
        }
        return $this;
    }

    public static function userConnected(): bool
    {
        return isset($_SESSION['user']) && null !== ($_SESSION['user'])->getId();
    }

    /**
     * @return void
     */
    public function redirectIfConnected(): void
    {
        if(self::userConnected()) {
            $this->render('admin/space-admin');
        }
    }

    /**
     * Return a form field value or default
     * @param string $field
     * @param $default
     * @return void
     */
    public function getFormField(string $field, $default = null)
    {
        if (!isset($_POST[$field])) {
            return (null === $default) ? '' : $default;
        }

        return $_POST[$field];
    }

    /**
     * Return true if a form were submitted.
     * @return bool
     */
    public function isFormSubmitted(): bool
    {
        return isset($_POST['save']);
    }

    /**
     * Return the connected user of null if no user connected.
     * @return User|null
     */
    public function getConnectedUser(): ?User
    {
        if(!self::userConnected()) {
            return null;
        }

        return ($_SESSION['user']);
    }
}