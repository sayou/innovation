<?php

namespace App\Models;

use PDO;

class Post extends \Core\Model{
    
    public static function getAll(){
        
        try{
            $db = static::getDB();
            $stmt = $db->query("SELECT ID,Title,Content FROM posts ");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }
    
}

?>