<?php

namespace App\Models;

use PDO;

class SuperAdminModel extends \Core\Model{
	

	//superAdmin : Hassan

		// begin statistiques :
		public static function getProjectNumber(){
	        try{
	        	$db = static::getDB();
	           	$stmt = $db->query("SELECT count(*) AS nbr FROM projetinfos");	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result[0]['nbr'];
	        }catch(PDOException $e){echo $e->getMessage();}
	    }

	    public static function getCoachesNumber(){
	        try{
	        	$db = static::getDB();
	           	$stmt = $db->query("SELECT count(*) AS nbr FROM users WHERE role='coach'");	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result[0]['nbr'];
	        }catch(PDOException $e){echo $e->getMessage();}
	    }

	    public static function getJurysNumber(){
	        try{
	        	$db = static::getDB();
	           	$stmt = $db->query("SELECT count(*) AS nbr FROM users WHERE role='jury'");	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result[0]['nbr'];
	        }catch(PDOException $e){echo $e->getMessage();}
	    }

	    public static function getSuperAdminsNumber(){
	        try{
	        	$db = static::getDB();
	           	$stmt = $db->query("SELECT count(*) AS nbr FROM users WHERE role='admin'");	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result[0]['nbr'];
	        }catch(PDOException $e){echo $e->getMessage();}
	    }
		// end statistiques.


	    // get project, lead & membres infos

	    public static function getListOfProjects(){
	        try{
	        	$db = static::getDB();
				$stmt = $db->query("SELECT p.id, p.idee, l.nomPrenom, l.email, count(m.id) AS nbrMembres FROM projetinfos p, leadduprojetinfos l, membres m WHERE p.idLead = l.id AND p.id = m.idProjet GROUP BY p.id");	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result;
	        }catch(PDOException $e){echo $e->getMessage();}
		}

		public static function getFullProjectInfos($idProjet){
	        try{
	        	$db = static::getDB();
				$stmt = $db->query("SELECT * FROM projetinfos WHERE id = ".$idProjet);	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result;
	        }catch(PDOException $e){echo $e->getMessage();}
		}

		public static function getLeadInfos($idLead){
	        try{
	        	$db = static::getDB();
				$stmt = $db->query("SELECT * FROM leadduprojetinfos WHERE id = ".$idLead);	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result;
	        }catch(PDOException $e){echo $e->getMessage();}
		}

		public static function getMembresInfos($idProjet){
	        try{
	        	$db = static::getDB();
				$stmt = $db->query("SELECT * FROM membres WHERE idProjet = ".$idProjet);	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result;
	        }catch(PDOException $e){echo $e->getMessage();}
		}

		public static function getCoachesJurys(){
	        try{
	        	$db = static::getDB();
				$stmt = $db->query("SELECT * FROM users WHERE role = 'coach' OR role = 'jury'");	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result;
	        }catch(PDOException $e){echo $e->getMessage();}
		}

	   // end get project, lead & membres infos


		public static function addCoachesJurys($newUser){
			try{
				$db = static::getDB();
				$stmt = $db->prepare("INSERT INTO users(userName, email, motDePasse, role) VALUES(:username, :email, :motDePasse, :role)");				
				$stmt->bindParam(':username',  $newUser['username']);
				$stmt->bindParam(':email',  $newUser['email']);
				$stmt->bindParam(':motDePasse',  $newUser['password']);
				$stmt->bindParam(':role',  $newUser['role']);
				$stmt->execute();
				return 'true';
			}catch(PDOException $e){return 'false';}
		}

		public static function DeleteCoachesJurys($idUser){
			try{
				$db = static::getDB();
				$stmt = $db->prepare("DELETE FROM users WHERE id = :id");
				$stmt->bindParam(':id',  $idUser);
				$stmt->execute();
				return 'true';
			}catch(PDOException $e){return 'false';}
		}
}

?>