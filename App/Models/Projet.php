<?php

namespace App\Models;

use PDO;

class Projet extends \Core\Model{

    public static function getAllProjects(){
        try{
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM leadduprojetinfos,projetinfos WHERE leadduprojetinfos.id = projetinfos.idLead");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getAllCoachs(){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM users";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getProjetByCoach($idCoach){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM projetinfos WHERE idCoach = $idCoach ";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getProjetByID($id){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM projetinfos WHERE id = $id LIMIT 1";
            $stmt = $db->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getProjetDataByCoach($idCoach){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM leadduprojetinfos,projetinfos WHERE leadduprojetinfos.id = projetinfos.idLead AND idCoach = $idCoach ";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getCountProjetByCoach($idProjet,$idCoach){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM projetinfos WHERE id = $idProjet AND idCoach = $idCoach ";
            $stmt = $db->query($sql);
            $count = $stmt->rowCount();
            return $count;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function addingCoachToProject($idProjet,$idCoach){
        try{
            $db = static::getDB();
            $sql = "UPDATE projetinfos SET idCoach = $idCoach WHERE id = $idProjet";
            $stmt = $db->exec($sql);
            return $stmt;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function deleteCoachFromProject($idProjet,$idCoach){
        try{
            $db = static::getDB();
            $sql = "UPDATE projetinfos SET idCoach = NULL WHERE id = $idProjet AND idCoach = $idCoach";
            $stmt = $db->exec($sql);
            return $stmt;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getEtatAvancement($idProjet){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM etatavancement WHERE idProjet = $idProjet";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getCountEtatAvancement($idProjet){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM etatavancement WHERE idProjet = $idProjet";
            $stmt = $db->query($sql);
            $result = $stmt->rowCount();
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }
}

?>