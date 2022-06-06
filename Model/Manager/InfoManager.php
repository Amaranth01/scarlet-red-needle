<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Info;

class InfoManager
{
    /**
     * @return array
     */
    public static function findInfo (): array
    {
        $info = [];
        $query = DB::getPDO()->query("SELECT * FROM info");
        foreach ($query->fetchAll() as $infoData) {
            $info = (new Info())
                ->setId($infoData['id'])
                ->setContent($infoData['content'])
            ;
        }
        return $info;
    }

    /**
     * @param $newContent
     * @param $id
     */
    public static function editInfo($newContent, $id)
    {
        $stmt = DB::getPDO()->prepare("UPDATE info SET content = :newContent WHERE id= :id");

        $stmt->bindParam('newContent', $newContent);
        $stmt->bindParam('id', $id);

        $stmt->execute();
    }

    /**
     * @param $id
     * @return Info
     */
    public static function getInfo($id): Info
    {
        $stmt = DB::getPDO()->query("SELECT * FROM info WHERE id = '$id'");
        $stmt = $stmt->fetch();
        return (new Info())
            ->setId($id)
            ->setContent($stmt['content'])
        ;

    }
}