<?php

namespace App\Models;

use PDO;

class Projet extends \Core\Model{

    public static function getAllProjects(){
        try{
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM leadduprojetinfos,projetinfos WHERE leadduprojetinfos.id = projetinfos.idLead AND nextEtap = 1");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getAllCoachs(){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM users WHERE role = 'coach'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getProjetByCoach($idCoach){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM coachProjet WHERE idCoach = $idCoach";
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

    public static function getProjetInformationByID($id){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM projetinfos,leadduprojetinfos WHERE projetinfos.id = $id AND projetinfos.idLead = leadduprojetinfos.id LIMIT 1";
            $stmt = $db->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getProjetDataByCoach($idCoach){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM leadduprojetinfos,projetinfos,coachProjet WHERE leadduprojetinfos.id = projetinfos.idLead AND projetinfos.id = coachProjet.idProjet AND coachProjet.idCoach = $idCoach ";
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
            $sql = "INSERT INTO coachProjet (idProjet,idCoach) VALUES ($idProjet,$idCoach)";
            $stmt = $db->exec($sql);
            return $stmt;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function deleteCoachFromProject($idProjet,$idCoach){
        try{
            $db = static::getDB();
            $sql = "DELETE FROM coachProjet WHERE idProjet = $idProjet AND idCoach = $idCoach";
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

    public static function addNewCommentsJury($idjury,$idprojet,$comments){
        try{
            $db = static::getDB();
            $sql = "INSERT INTO jurycomments (idJury, idProjet, Commentaire) VALUES ($idjury, $idprojet, '$comments');";
            $stmt = $db->exec($sql);
            return $stmt;
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function getJuryCommentsByID($id,$idjury){
        try{
            $db = static::getDB();
            $sql = "SELECT * FROM jurycomments WHERE idProjet = $id AND idJury = $idjury";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
    }
}

?>