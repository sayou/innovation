<?php

namespace App\Models;

use PDO;

class Coachs extends \Core\Model{
    
    public static function getAll(){
        
        try{
            $db = static::getDB();
            $stmt = $db->query("SELECT ID,Title,Content FROM posts ");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getCoachById($id){
        try{
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM users WHERE id = $id ");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function updateCoach($password,$id){
        try{
            $db = static::getDB();
            $sql = "UPDATE users SET motDePasse = '$password' WHERE id = $id";
            $stmt = $db->exec($sql);
            return $stmt;
        }catch(PDOException $e){echo $e->getMessage();}
    }
    
}

?>