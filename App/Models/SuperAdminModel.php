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
				$stmt = $db->query("SELECT p.id, p.idee, l.nomPrenom, l.email FROM projetinfos p, leadduprojetinfos l WHERE p.idLead = l.id AND nextEtap = 0");	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result;
	        }catch(PDOException $e){echo $e->getMessage();}
		}

		public static function getListOfProjectsSelected(){
	        try{
	        	$db = static::getDB();
				$stmt = $db->query("SELECT p.id, p.idee, l.nomPrenom, l.email FROM projetinfos p, leadduprojetinfos l WHERE p.idLead = l.id AND nextEtap = 1");	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result;
	        }catch(PDOException $e){echo $e->getMessage();}
		}

		public static function getListofCoach($id){
			try{
	        	$db = static::getDB();
				$stmt = $db->query("SELECT * FROM projetinfos, coachProjet, users WHERE users.id = coachProjet.idCoach AND coachProjet.idProjet = projetinfos.id AND projetinfos.id = $id");	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result;
	        }catch(PDOException $e){echo $e->getMessage();}
		}

		public static function getListofProjectsByCoach($idCoach){
			try{
	        	$db = static::getDB();
				$stmt = $db->query("SELECT * FROM leadduprojetinfos, projetinfos, coachProjet, users WHERE users.id = coachProjet.idCoach AND coachProjet.idProjet = projetinfos.id AND leadduprojetinfos.id = projetinfos.idLead AND coachProjet.idCoach = $idCoach");	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	            return $result;
	        }catch(PDOException $e){echo $e->getMessage();}
		}

		public static function editProjetSelected($id){
			try{
				$db = static::getDB();
				   $stmt = $db->prepare("UPDATE projetinfos SET nextEtap = 1 WHERE id = " . $id);
				$result = $stmt->execute();
				return $result;
			}catch(PDOException $e){echo $e->getMessage();}
		}

		public static function editProjet3($id){
			try{
				$db = static::getDB();
				$stmt = $db->prepare("UPDATE projetinfos SET nextEtap = 1 WHERE nextEtap = 3");
				$result = $stmt->execute();
				$stmt = $db->prepare("UPDATE projetinfos SET nextEtap = 3 WHERE id = " . $id);
				$result = $stmt->execute();
				return $result;
			}catch(PDOException $e){echo $e->getMessage();}
		}

		public static function editProjet2($id){
			try{
				$db = static::getDB();
				$stmt = $db->prepare("UPDATE projetinfos SET nextEtap = 1 WHERE nextEtap = 2");
				$result = $stmt->execute();
				$stmt = $db->prepare("UPDATE projetinfos SET nextEtap = 2 WHERE id = " . $id);
				$result = $stmt->execute();
				return $result;
			}catch(PDOException $e){echo $e->getMessage();}
		}

		public static function editProjet1($id){
			try{
				$db = static::getDB();
				$stmt = $db->prepare("UPDATE projetinfos SET nextEtap = 1 WHERE nextEtap = 11");
				$result = $stmt->execute();
				$stmt = $db->prepare("UPDATE projetinfos SET nextEtap = 11 WHERE id = " . $id);
				$result = $stmt->execute();
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

		public static function getAdminByID($id){
			try{
				$db = static::getDB();
				$stmt = $db->query("SELECT * FROM users WHERE id = $id");
				$result = $stmt->fetch();
				return $result;
			}catch(PDOException $e){return 'false';}
		}
}

?>