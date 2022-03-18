<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;
use App\Model\Entity\Role;

class UserManager
{
    public const TABLE = 'user';
    public const TABLE_USER_ROLE = 'user_role';

    /**
     * Return all available users.
     * @return array
     */
    public static function getAll(): array
    {
        $users = [];
        $result = DB::getPDO()->query("SELECT * FROM " . self::TABLE);

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
    public static function makeUser(array $data): User
    {
        $user = (new User())
            ->setId($data['id'])
            ->setPassword($data['password'])
            ->setEmail($data['email'])
            ->setUsername($data['username'])
        ;

        return $user->setRole();
    }

    /**
     * Check if a user exists.
     * @param int $id
     * @return bool
     */
    public static function userExists(int $id): bool
    {
        $result = DB::getPDO()->query("SELECT count(*) FROM " . self::TABLE . " WHERE id = $id");
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
        $stmt->bindParam(':email', $mail);
        return $stmt->execute() ? self::makeUser($stmt->fetch()) : null;
    }

//    /**
//     * @param User $user
//     * @return bool
//     */
//    public static function addUser(User $user): bool
//    {
//        $stmt = DB::getPDO()->prepare("
//            INSERT INTO ".self::TABLE." (email, username, password)
//            VALUES (:email, :username, :password)
//        ");
//
//        $stmt->bindValue(':email', $user->getEmail());
//        $stmt->bindValue(':username', $user->getUsername());
//        $stmt->bindValue(':password', $user->getPassword());
//
//        $result = $stmt->execute();
//        $user->setId(DB::getPDO()->lastInsertId());
//        if($result) {
//            $role = RoleManager::getRoleByName(RoleManager::ROLE_USER);
//            $resultRole = DB::getPDO()->exec("
//                INSERT INTO ".self::TABLE_USER_ROLE. " (user_fk, role_fk) VALUES (".$user->getId().", ".$role->getId().")
//            ");
//
//        }
//        return $result && $resultRole;
//    }

}