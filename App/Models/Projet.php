<?php

namespace App\Models;

use PDO;

class Projet extends \Core\Model{

    public static function getAllProjects(){
        try{
            $db = static::getDB();
            $stmt = $db->query("SELECT *, COUNT(membres.nomPrenom) AS TOTALMembers FROM leadduprojetinfos,membres,projetinfos WHERE projetinfos.id = membres.idProjet AND leadduprojetinfos.id = projetinfos.idLead");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }
}

?>