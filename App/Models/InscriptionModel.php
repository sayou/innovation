<?php

namespace App\Models;

use PDO;

class InscriptionModel extends \Core\Model{
	
	//inscription : Hassan
	 public static function addUserInfos($lead, $role){
        try{
        	$db = static::getDB();
           	$stmt = $db->prepare("INSERT INTO users(email, motDePasse, role) VALUES(:email, :motDePasse, :role)");				
			$stmt->bindParam(':email',  $lead['leadAdresseMail']);
			$stmt->bindParam(':motDePasse',  $lead['motDePasse']);
			$stmt->bindParam(':role',  $role);
			$stmt->execute();
			return true;
        }catch(PDOException $e){echo $e->getMessage();}
    }



    public static function addLeadInfos($lead){
        try{
        	$db = static::getDB();
           	$stmt = $db->prepare("INSERT INTO leadduprojetinfos(nomPrenom, dateNaissance, email, tel, etablissement, niveauDeFormation, experienceProfessionnelles, motivations) VALUES(:np, :dn, :em, :t, :eb, :nf, :ep, :m)");				
			$stmt->bindParam(':np',  $lead['leadNomPrenom']);
			$stmt->bindParam(':dn',  $lead['leadDateNaissance']);
			$stmt->bindParam(':em',  $lead['leadAdresseMail']);
			$stmt->bindParam(':t',   $lead['leadTel']);
			$stmt->bindParam(':eb',  $lead['leadEtablissement']);
			$stmt->bindParam(':nf',  $lead['leadNiveauDeFormation']);
			$stmt->bindParam(':ep',  $lead['leadExperienceProfessionelles']);
			$stmt->bindParam(':m',   $lead['leadMotivation']);
			$stmt->execute();
			return $db->lastInsertId();
        }catch(PDOException $e){echo $e->getMessage();}
    }
 

    public static function addProjetInfos($projet, $idLead){
        try{
        	$db = static::getDB();
           	$stmt = $db->prepare("INSERT INTO projetinfos(idee, descriptionProbleme, descriptionSolution, cibles, changement, valeurSociale, valeurEconomique, ressourcesHumaines, moyensTechniqueEtFinancier, activites, idLead) VALUES(:idee, :dp, :ds, :cibles, :changement, :vs, :ve, :rh, :mtf, :activites, :idLead)");				
			$stmt->bindParam(':idee', 		$projet['monIdee']);
			$stmt->bindParam(':dp',   		$projet['descriptionProbleme']);
			$stmt->bindParam(':ds',   		$projet['descriptionSolution']);
			$stmt->bindParam(':cibles',     $projet['cible']);
			$stmt->bindParam(':changement', $projet['changement']);
			$stmt->bindParam(':vs', 		$projet['valeurSociale']);
			$stmt->bindParam(':ve', 		$projet['valeurEconomique']);
			$stmt->bindParam(':rh', 		$projet['ressourcesHumaines']);
			$stmt->bindParam(':mtf', 		$projet['moyensTechniqueEtFinancier']);
			$stmt->bindParam(':activites', 	$projet['activites']);
			$stmt->bindParam(':idLead', 	$idLead);
			$stmt->execute();
			return $db->lastInsertId();
        }catch(PDOException $e){echo $e->getMessage();}
    }


    public static function addMembresInfos($membres, $idProjet){
        try{

        	$db = static::getDB();
			$stmt = $db->prepare("INSERT INTO membres(nomPrenom, dateNaissance, niveauDeFormation, etablissement, idProjet) VALUES(:np, :dn, :nf, :et, :id)");	
			if(isset($membres['membreNomPrenom'])){
           	for ($i=0; $i < count($membres['membreNomPrenom']); $i++) { 
				$stmt->bindParam(':np', 		$membres['membreNomPrenom'][$i]);
				$stmt->bindParam(':dn',   		$membres['membreDateNaissance'][$i]);
				$stmt->bindParam(':nf',   		$membres['membreEtablissement'][$i]);
				$stmt->bindParam(':et',     	$membres['membreNiveauDeFormation'][$i]);
				$stmt->bindParam(':id', 		$idProjet);
				$stmt->execute();
			}
		}
			return true;
        }catch(PDOException $e){echo $e->getMessage();}
	}
	
	//modification & etat avancement : Ghassan
	public static function findLeadById($idLead){
		try{
            $db = static::getDB();
            $result = $db->query("SELECT * FROM `leadduprojetinfos` WHERE id = " . $idLead . " LIMIT 1");
			$data = $result->fetchAll(PDO::FETCH_ASSOC)[0];
			return $data;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
	}

	public static function findLeadByEmail($email){
		try{
            $db = static::getDB();
			$result = $db->query("SELECT * FROM `leadduprojetinfos` WHERE email = '$email' LIMIT 1");
			$count = $result->rowCount();
            return $count;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
	}

	public static function findProjectByLead($idLead){
		try{
            $db = static::getDB();
            $result = $db->query("SELECT * FROM `projetinfos` WHERE idLead = " . $idLead ." LIMIT 1");
			$data = $result->fetchAll(PDO::FETCH_ASSOC)[0];
			return $data;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
	}

	public static function findMembresByProject($idProjet){
		try{
            $db = static::getDB();
            $result = $db->query("SELECT * FROM `membres` WHERE idProjet = " . $idProjet);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
	}

	public static function editLeadInfos($lead, $idLead){
        try{
        	$db = static::getDB();
           	$stmt = $db->prepare("UPDATE `leadduprojetinfos` SET nomPrenom = :np, dateNaissance = :dn, email = :em, tel = :t, etablissement = :eb, niveauDeFormation = :nf, experienceProfessionnelles = :ep, motivations = :m WHERE id = " . $idLead);
			$stmt->bindParam(':np',  $lead['leadNomPrenom']);
			$stmt->bindParam(':dn',  $lead['leadDateNaissance']);
			$stmt->bindParam(':em',  $lead['leadAdresseMail']);
			$stmt->bindParam(':t',   $lead['leadTel']);
			$stmt->bindParam(':eb',  $lead['leadEtablissement']);
			$stmt->bindParam(':nf',  $lead['leadNiveauDeFormation']);
			$stmt->bindParam(':ep',  $lead['leadExperienceProfessionelles']);
			$stmt->bindParam(':m',   $lead['leadMotivation']);
			$stmt->execute();
			return $db->lastInsertId();
        }catch(PDOException $e){echo $e->getMessage();}
    }
 
    public static function editProjetInfos($projet, $idProjet, $idLead){
        try{
        	$db = static::getDB();					
           	$stmt = $db->prepare("UPDATE `projetinfos` SET idee = :idee, descriptionProbleme = :dp, descriptionSolution = :ds, cibles = :cibles, changement = :changement, valeurSociale = :vs, valeurEconomique = :ve, ressourcesHumaines = :rh, moyensTechniqueEtFinancier = :mtf, activites = :activites, idLead = :idLead WHERE id = " . $idProjet);
			$stmt->bindParam(':idee', 		$projet['monIdee']);
			$stmt->bindParam(':dp',   		$projet['descriptionProbleme']);
			$stmt->bindParam(':ds',   		$projet['descriptionSolution']);
			$stmt->bindParam(':cibles',     $projet['cible']);
			$stmt->bindParam(':changement', $projet['changement']);
			$stmt->bindParam(':vs', 		$projet['valeurSociale']);
			$stmt->bindParam(':ve', 		$projet['valeurEconomique']);
			$stmt->bindParam(':rh', 		$projet['ressourcesHumaines']);
			$stmt->bindParam(':mtf', 		$projet['moyensTechniqueEtFinancier']);
			$stmt->bindParam(':activites', 	$projet['activites']);
			$stmt->bindParam(':idLead', 	$idLead);
			$stmt->execute();
			return $db->lastInsertId();
        }catch(PDOException $e){echo $e->getMessage();}
    }

    public static function editMembresInfos($membres, $idProjet){
        try{

			self::deleteMembers($idProjet);

			$db = static::getDB();
        	$stmt = $db->prepare("INSERT INTO membres(nomPrenom, dateNaissance, niveauDeFormation, etablissement, idProjet) VALUES(:np, :dn, :nf, :et, :id)");	
			if(isset($membres['membreNomPrenom'])){
				for ($i=0; $i < count($membres['membreNomPrenom']); $i++) { 
					$stmt->bindParam(':np', 		$membres['membreNomPrenom'][$i]);
					$stmt->bindParam(':dn',   		$membres['membreDateNaissance'][$i]);
					$stmt->bindParam(':nf',   		$membres['membreEtablissement'][$i]);
					$stmt->bindParam(':et',     	$membres['membreNiveauDeFormation'][$i]);
					$stmt->bindParam(':id', 		$idProjet);
					$stmt->execute();
				}
			}
			return true;
        }catch(PDOException $e){echo $e->getMessage();}
	}

	public static function deleteMembers($idProjet){
		try{
            $db = static::getDB();
            $requete = "DELETE FROM `membres` WHERE idProjet = " . $idProjet;
            $res = $db->exec($requete);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
	}

	public static function addProgress($idLead, $progress){

		$projet = self::findProjectByLead($idLead);
		try{
			$dateAjout = Date('d/m/Y H:i:s');

        	$db = static::getDB();
           	$stmt = $db->prepare("INSERT INTO `etatavancement`(etat, commentaire, dateAjout, idProjet) VALUES(:e, :c, :da, :idp)");				
			$stmt->bindParam(':e',  $progress["etat"]);
			$stmt->bindParam(':c',  $progress["pourcentage"]);
			$stmt->bindParam(':da',  $dateAjout);
			$stmt->bindParam(':idp',  $projet["id"]);
			$stmt->execute();
			return $db->lastInsertId();
        }catch(PDOException $e){echo $e->getMessage();}
	}
	//end modification

	public static function getByEmailAndPassword($email,$password,$role){
		try{
            $db = static::getDB();
			$result = $db->query("SELECT * FROM users WHERE email = '$email' AND motDePasse = '$password' AND role = '$role' LIMIT 1");
			$count = $result->rowCount();
			if($count == 1){
				$result = $db->query("SELECT * FROM leadduprojetinfos WHERE email = '$email' LIMIT 1");
				return $result->fetchAll(PDO::FETCH_ASSOC);
			}else{
				return null;
			}
        }catch(PDOException $e){
            echo $e->getMessage();
        }
	}
}

?>