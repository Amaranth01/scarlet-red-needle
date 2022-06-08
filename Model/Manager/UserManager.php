<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;
use App\Model\Entity\Role;

class UserManager
{
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
        $role = RoleManager::getRoleById($data['role_id']);
        return (new User())
            ->setId($data['id'])
            ->setPassword($data['password'])
            ->setEmail($data['email'])
            ->setUsername($data['username'])
            ->setRole($role);
    }

    /**
     * Check if a user exists.
     * @param string $email
     * @return array|null
     */
    public static function userExists(string $email): ?array
    {
        $result = DB::getPDO()->query("SELECT count(*) FROM user WHERE email = '$email'");
        return $result ? $result->fetch() : null;
    }

    /**
     * Return a user based on itus id.
     * @param int $id
     * @return User
     */
    public static function getUser(int $id): ?User
    {
        $user = null;
        $stmt = DB::getPDO()->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);

        if($stmt->execute() && $data = $stmt->fetch()) {
            $user = self::makeUser($data);
        }
        return $user;
    }

    /**
     * Delete a user from user db.
     * @param int $id
     * @return bool
     */
    public static function deleteUser(int $id): bool
    {
        $stmt = DB::getPDO()->prepare("DELETE FROM user WHERE id = :id");

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    /**
     * Fetch a user by mail
     * @param string $email
     * @return User|null
     */
    public static function getUserByMail(string $email): ?User
    {
        $stmt = DB::getPDO()->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindValue(':email', $email);

        if($stmt->execute() && $data = $stmt->fetch()) {
            return self::makeUser($data);
        }
        return null;
    }

    /**
     * Check if a user exists with its email.
     * @param string $mail
     * @return array
     */
    public static function userMailExists(string $mail): ?array
    {
        $result = DB::getPDO()->query("SELECT count(*) FROM user WHERE email = '$mail'");
        return $result->fetch();
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

        $stmt->bindValue('email', $user->getEmail());
        $stmt->bindValue('username', $user->getUsername());
        $stmt->bindValue('password', $user->getPassword());
        $stmt->bindValue('role_id', $user->getRole()->getId());

        $result = $stmt->execute();
        $user->setId(DB::getPDO()->lastInsertId());
        return $result;
    }
}