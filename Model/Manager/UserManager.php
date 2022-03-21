<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;
use App\Model\Entity\Role;

class UserManager
{
    public const TABLE = 'user';

    /**
     * Return all available users.
     * @return array
     */
    public static function getAll(): array
    {
        $users = [];
        $result = DB::getPDO()->query("SELECT * FROM user" );

        if($result) {
            foreach ($result->fetchAll() as $data) {
                $users[] = self::makeUser($data);
            }
        }
        return $users;
    }

    /**
     * Create a new User Entity
     * @param array $data
     * @return User
     */
    private static function makeUser(array $data): User
    {
        $user = (new User())
            ->setId($data['id'])
            ->setPassword($data['password'])
            ->setEmail($data['email'])
            ->setUsername($data['username'])
        ;
        return $user->setRole((array)RoleManager::getRoleByName('user'));
    }

    /**
     * Check if a user exists.
     * @param string $mail
     * @return bool
     */
    public static function userExists(string $mail): bool
    {
        $result = DB::getPDO()->query("SELECT count(*) FROM " . self::TABLE . " WHERE email = $mail");
        return $result ? $result->fetch(): 0;
    }

    /**
     * Return a user based on itus id.
     * @param int $id
     * @return User
     */
    public static function getUser(int $id): ?User
    {
        $result = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $result ? self::makeUser($result->fetch()) : null;
    }

    /**
     * Delete a user from user db.
     * @param User $user
     * @return bool
     */
    public static function deleteUser(User $user): bool {
        if(self::userExists($user->getId())) {
            return DB::getPDO()->exec("
            DELETE FROM " . self::TABLE . " WHERE id = {$user->getId()}
        ");
        }
        return false;
    }

    /**
     * Fetch a user by mail
     * @param string $mail
     * @return User|null
     */
    public static function getUserByMail(string $mail): ?User
    {
        $stmt = DB::getPDO()->prepare("SELECT * FROM " . self::TABLE . " WHERE email = :email LIMIT 1");
        $stmt->bindParam('email', $mail);
        return $stmt->execute() ? self::makeUser($stmt->fetch()) : null;
    }

    /**
     * Check if a user exists with its email.
     * @param string $mail
     * @return bool
     */
    public static function userMailExists(string $mail): bool
    {
        $result = DB::getPDO()->query("SELECT count(*) as cnt FROM user WHERE email = $mail");
        return $result ? $result->fetch()['cnt'] : 0;
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function addUser(User $user): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO user (email, username, password, role_id)
            VALUES (:email, :username, :password, :role_id)
        ");

        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':role_id', $user->getRole());

        $result = $stmt->execute();
        $user->setId(DB::getPDO()->lastInsertId());
        if($result) {
            $role = RoleManager::getRoleByName(RoleManager::ROLE_USER);
            $resultRole = DB::getPDO()->exec("
                INSERT INTO user (role_id) VALUES (".$user->getId().", ".$role->getId().")
            ");
        }
        return $result && $resultRole;
    }
}