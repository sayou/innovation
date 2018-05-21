<?php

namespace App\Models;
use App\Models\fpdf;

class ProjectPDF extends FPDF
{
	function Header(){
        $titre = 'Hackathon - Innovation Sociale';
        // Arial gras 15
        $this->SetFont('Arial','B',15);
        // Calcul de la largeur du titre et positionnement
        $w = $this->GetStringWidth($titre)+6;
        $this->SetX((210-$w)/2);
        // Couleurs du cadre, du fond et du texte
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0,0,0);
        // Epaisseur du cadre (1 mm)
        $this->SetLineWidth(1);
        // Titre
        $this->Cell($w,9,utf8_decode($titre),1,1,'C',true);
        // Saut de ligne
        $this->Ln(10);
	}

	function Footer()
	{   
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Arial italique 8
        $this->SetFont('Arial','I',8);
        // Couleur du texte en gris
        $this->SetTextColor(128);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
    
    function TitreChapitre($num, $libelle)
    {
        // Arial 12
        $this->SetFont('Arial','',12);
        // Couleur de fond
        $this->SetFillColor(200,220,255);
        // Titre
        $this->Cell(0,6,utf8_decode("Séction $num : $libelle"),0,1,'L',true);
        // Saut de ligne
        $this->Ln(4);
    }

    function CorpsSectionProjet($projet)
    {
        
        // $attributs = [
        //     "Idée",
        //     "Description du problème",
        //     "Description de la solution",
        //     "Cibles",
        //     "Changement",
        //     "Valeur sociale",
        //     "Valeur économique",
        //     "Ressources humaines",
        //     "Moyens téchniques et financiers",
        //     "Activités"
        // ];
        // $nbr = 0;
        // foreach($projet as $key => $value){
        //     if($nbr == 10){
        //         break;
        //     }else{
                // Arial 12 BOLD
                $this->SetFont('Arial','B',12);
                // Couleur de fond
                $this->SetFillColor(224,224,224);
                //attribut en gras
                //$this->Cell(0,6,utf8_decode($attributs[$nbr]),0,1,'C',true);
                $this->Cell(0,6,utf8_decode("L'idée du projet"),0,1,'C',true);
                // Saut de ligne
                $this->Ln();
                // Times 12
                $this->SetFont('Times','',12);
                // Sortie du texte justifié
                //$this->MultiCell(0,5,$value);
                $this->MultiCell(0,5,utf8_decode($projet));
                // Saut de ligne
                $this->Ln();
        //         $nbr++;
        //     }
            
        // }
    }

    function CorpsSectionLead($lead)
    {
        $attributs = ["Nom & Prénom", "Date de naissance", "Email", "Téléphone", "Etablissement", "Niveau de formation", "Expériences profetionnelles", "Motivations"];
        $nbr = 0;
        foreach($lead as $key => $value){
            // Arial 12 BOLD
            $this->SetFont('Arial','B',12);
            // Couleur de fond
            $this->SetFillColor(224,224,224);
            //attribut en gras
            $this->Cell(0,6,utf8_decode($attributs[$nbr]),0,1,'C',true);
            // Saut de ligne
            $this->Ln();
            // Times 12
            $this->SetFont('Times','',12);
            // Sortie du texte justifié
            $this->MultiCell(0,5,utf8_decode($value));
            // Saut de ligne
            $this->Ln();
            $nbr++;
        }
    }

    function CorpsSectionMembres($membres)
    {
        $attributs = ["Nom & Prénom", "Date de naissance", "Niveau de formation", "Etablissement"];
        $this->BasicTable($attributs, $membres);
        // $taille = count($membres);
        // $decrement = $taille - 1;

        // foreach($membres as $key => $value){
        //     $cmp = 0;
        //     $nbr = $taille - $decrement;
        //     // Arial 12 BOLD
        //     $this->SetFont('Arial','B',12);
        //     // Couleur de fond
        //     $this->SetFillColor(204,255,204);
        //     //attribut en gras
        //     $this->Cell(0,6,utf8_decode("Membre $nbr"),0,1,'C',true);
        //     // Saut de ligne
        //     $this->Ln(4);

        //     foreach($value as $k => $v){
        //         // Arial 12 BOLD
        //         $this->SetFont('Arial','B',12);
        //         // Couleur de fond
        //         $this->SetFillColor(224,224,224);
        //         //attribut en gras
        //         $this->Cell(0,6,utf8_decode($attributs[$cmp]),0,1,'C',true);
        //         // Saut de ligne
        //         $this->Ln();
        //         // Times 12
        //         $this->SetFont('Times','',12);
        //         // Sortie du texte justifié
        //         $this->MultiCell(0,5,$v);
        //         // Saut de ligne
        //         $this->Ln();
        //         $cmp++;
        //     }

        //     $decrement -= 1;
        // }
    }

    function BasicTable($header, $data){
        // En-t�te
        foreach($header as $col){
            $this->SetFont('Arial','B',12);
            $this->SetFillColor(204,255,204);
            $this->Cell(45,7,utf8_decode($col),1);
        }
        $this->Ln();
        // Donn�es
        foreach($data as $row)
        {
            foreach($row as $col){
                $this->SetFont('Times','',12);
                $this->Cell(45,6,utf8_decode($col),1);
            }
            $this->Ln();
        }
    }

    function AjouterSection($projet, $lead, $membres)
    {   
        $this->AddPage();
        $this->TitreChapitre(1, "Projet");
        $this->CorpsSectionProjet($projet);

        $this->TitreChapitre(2, "Lead");
        $this->CorpsSectionLead($lead);
        
        $this->AddPage();
        $this->TitreChapitre(3,"Membres");
        $this->CorpsSectionMembres($membres);
    }
}

?>