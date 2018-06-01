<?php

namespace App\Models;

use PDO;

class HomeModel extends \Core\Model{
	
	
	public static function getProjectAndLeadInfosNonSelected(){
        try{
        	$db = static::getDB();
			$stmt = $db->query("SELECT p.idee, p.descriptionProbleme, l.nomPrenom, l.email FROM projetinfos p, leadduprojetinfos l WHERE p.idLead = l.id AND p.nextEtap = 0");	
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
	}

	public static function getProjectAndLeadInfosSelected(){
        try{
        	$db = static::getDB();
			$stmt = $db->query("SELECT p.idee, p.descriptionProbleme, l.nomPrenom, l.email FROM projetinfos p, leadduprojetinfos l WHERE p.idLead = l.id AND p.nextEtap != 0");	
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
	}

	public static function getProjectAndLeadInfosThirdOne(){
        try{
        	$db = static::getDB();
			$stmt = $db->query("SELECT p.idee, p.descriptionProbleme, l.nomPrenom, l.email FROM projetinfos p, leadduprojetinfos l WHERE p.idLead = l.id AND p.nextEtap = 3 LIMIT 1");	
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
	}

	public static function getProjectAndLeadInfosSecondOne(){
        try{
        	$db = static::getDB();
			$stmt = $db->query("SELECT p.idee, p.descriptionProbleme, l.nomPrenom, l.email FROM projetinfos p, leadduprojetinfos l WHERE p.idLead = l.id AND p.nextEtap = 2 LIMIT 1");	
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
	}

	public static function getProjectAndLeadInfosWinner(){
        try{
        	$db = static::getDB();
			$stmt = $db->query("SELECT p.idee, p.descriptionProbleme, l.nomPrenom, l.email FROM projetinfos p, leadduprojetinfos l WHERE p.idLead = l.id AND p.nextEtap = 11 LIMIT 1");	
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
	}

	public static function getByPasswordAndName($name,$password){
		try{
        	$db = static::getDB();
			$stmt = $db->query("SELECT * FROM users WHERE userName = '$name' AND motDePasse = '$password' LIMIT 1");	
			$result = $stmt->fetch();
            return $result;
        }catch(PDOException $e){echo $e->getMessage();}
	}
	
}	

?>