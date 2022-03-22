<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Role;
use App\Model\Entity\User;

class RoleManager
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';

    /**
     * Return a role by name.
     * @param string $roleName
     * @return Role
     */
    public static function getRoleByName(string $roleName): Role
    {
        $role = new Role();
        $rQuery = DB::getPDO()->query("
            SELECT * FROM role WHERE role_name = '".$roleName."'
        ");
        if($rQuery && $roleData = $rQuery->fetch()) {
            $role->setId($roleData['id']);
            $role->setRoleName($roleData['role_name']);
        }
        return $role;
    }

    /**
     * @param int $id
     * @return Role
     */
    public static function getRoleById(int $id): Role
    {
        $roleId = new Role();
        $request = DB::getPDO()->query("
            SELECT * FROM user WHERE role_id = '".$id."'
        ");
        if($request && $roleData = $request->fetch()) {
            $roleId->setId($roleData['id']);
        }
        return $roleId;
    }
}