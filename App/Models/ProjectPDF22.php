<?php

namespace App\Models;
use App\Models\fpdf;

class ProjectPDF extends FPDF
{
	function Header(){
        
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
    

    function CorpsSectionProjet($projet)
    {
        $this->Ln(20);

       
        $this->Ln(20);
        $titre = 'Recu Hackathon - Innovation Sociale';
        // Arial gras 15
        $this->SetFont('Arial','B',15);
        // Calcul de la largeur du titre et positionnement
        $w = $this->GetStringWidth($titre)+100;
        $this->SetX((210-$w)/2);
        // Couleurs du cadre, du fond et du texte
        $this->SetDrawColor(36,96,166);
        $this->SetFillColor(36,96,166);
        $this->SetTextColor(255,255,255);
        // Epaisseur du cadre (1 mm)
        $this->SetLineWidth(2);
        // Titre
        $this->Cell($w,9,$titre,1,1,'C',true);


        $data = 'Recu Hackathon ';
        $this->GetStringWidth($data);
        $this->SetTextColor(0,0,0);
        $this->Cell(0,13,$data,1,1,'C',true);
        // Saut de ligne
        $this->Ln(10);

        $attributs = [
            "Idee",
            "Description du probleme",
            "Description de la solution",
            "Cibles",
            "Changement",
            "Valeur sociale",
            "Valeur economique",
            "Ressources humaines",
            "Moyens techniques et financiers",
            "Activites"
        ];
        $nbr = 0;
        foreach($projet as $key => $value){
            if($nbr == 10){
                break;
            }else{
                // Arial 12 BOLD
            $this->SetFont('Arial','B',12);
            // Couleur de fond
            $this->SetFillColor(224,224,224);
            //attribut en gras
            $this->Cell(0,6,$attributs[$nbr],0,1,'C',true);
            // Saut de ligne
            $this->Ln();
            // Times 12
            $this->SetFont('Times','',12);
            // Sortie du texte justifié
            $this->MultiCell(0,5,$value);
            // Saut de ligne
            $this->Ln();
            $nbr++;
            }
            
        }
    }

    function CorpsSectionLead($lead)
    {
        $attributs = ["Nom & Prenom", "Date de naissance", "Email", "Telephone", "Etablissement", "Niveau de formation", "Experiences profetionnelles", "Motivations"];
        $nbr = 0;
        foreach($lead as $key => $value){
            // Arial 12 BOLD
            $this->SetFont('Arial','B',12);
            // Couleur de fond
            $this->SetFillColor(224,224,224);
            //attribut en gras
            $this->Cell(0,6,$attributs[$nbr],0,1,'C',true);
            // Saut de ligne
            $this->Ln();
            // Times 12
            $this->SetFont('Times','',12);
            // Sortie du texte justifié
            $this->MultiCell(0,5,$value);
            // Saut de ligne
            $this->Ln();
            $nbr++;
        }
    }

    function CorpsSectionMembres($membres)
    {
        $attributs = ["Nom & Prenom", "Date de naissance", "Niveau de formation", "Etablissement"];

        $taille = count($membres);
        $decrement = $taille - 1;

        foreach($membres as $key => $value){
            $cmp = 0;
            $nbr = $taille - $decrement;
            // Arial 12 BOLD
            $this->SetFont('Arial','B',12);
            // Couleur de fond
            $this->SetFillColor(204,255,204);
            //attribut en gras
            $this->Cell(0,6,"Membre $nbr",0,1,'C',true);
            // Saut de ligne
            $this->Ln(4);

            foreach($value as $k => $v){
                // Arial 12 BOLD
                $this->SetFont('Arial','B',12);
                // Couleur de fond
                $this->SetFillColor(224,224,224);
                //attribut en gras
                $this->Cell(0,6,$attributs[$cmp],0,1,'C',true);
                // Saut de ligne
                $this->Ln();
                // Times 12
                $this->SetFont('Times','',12);
                // Sortie du texte justifié
                $this->MultiCell(0,5,$v);
                // Saut de ligne
                $this->Ln();
                $cmp++;
            }

            $decrement -= 1;
        }
    }

    function AjouterSection($num, $titre, $data)
    {   
        $this->AddPage();
        if($num == 1) $this->CorpsSectionProjet($data);
        else if($num == 2) $this->CorpsSectionLead($data);
        else $this->CorpsSectionMembres($data);
    }
}

?>