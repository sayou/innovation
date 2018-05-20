<?php

namespace App\Controllers\Coach;
use \Core\View;
use \App\Models\Projet;

class Coach extends \Core\Controller{
    
    protected function before(){
        
    }
    
    protected function mesprojetsAction(){
        $datas = null;
        $countdata = null;
        $id = isset($this->route_params['id']) ? $this->route_params['id'] : null; 
        
        
        if(!empty($id)){
            $result = "yes";
            $datas = Projet::getEtatAvancement($id);
            $countdata = Projet::getCountEtatAvancement($id);
        }else{$result = "no";}
        $allproject = Projet::getProjetDataByCoach(8);
            View::getView('Coach/mesprojets.html',[
                "projects"=>$allproject,
                "datas"=>$datas,
                "countdata"=>$countdata,
                "result"=>$result
                ]);
                
    }

    protected function projetAction(){
        if($id = filter_input(INPUT_POST,'id')){
            $type = filter_input(INPUT_POST,'type');
            if($type === 'true'){
                
                $result = Projet::getCountProjetByCoach($id,8);
                if($result > 0){
                    echo "new PNotify({
                        title: 'Ooops',
                        text: 'Malheureusement ce projet a déà un coach',
                        type: 'error',
                        styling: 'bootstrap3'
                    });";
                }else{ 
                    $res = Projet::addingCoachToProject($id,8);
                    if($res > 0){
                        echo "<script>new PNotify({
                            title: 'Super',
                            text: 'Vous êtes maintenant le coach de ce projet, vous permet le suivre maintenant',
                            type: 'success',
                            styling: 'bootstrap3'
                        });</script>";
                    }else{echo "<script>new PNotify({
                        title: 'Something wrong',
                        text: 'Vous pouvez maintenent suivit ce projet',
                        type: 'error',
                        styling: 'bootstrap3'
                    });</script>";}
                 }
            }else{
                $result = Projet::deleteCoachFromProject($id,8);
                if($result > 0){
                    echo "<script>new PNotify({
                        title: 'Cool',
                        text: 'Le projet est supprimé de votre listes des projets que vous suivez',
                        type: 'success',
                        styling: 'bootstrap3'
                    });</script>";
                }else{echo "<script>new PNotify({
                    title: 'Something wrong',
                    text: 'Vous pouvez maintenent suivit ce projet',
                    type: 'error',
                    styling: 'bootstrap3'
                });</script>";}
            }
            
        }else{
        $allprojectofcoach = Projet::getProjetByCoach(8);
        $allproject = Projet::getAllProjects();
        $coachs = Projet::getAllCoachs();
        View::getView('Coach/projets.html',[
            "projects"=>$allproject,
            "projectsofcoach"=>$allprojectofcoach,
            "coachs"=>$coachs
            ]);
    }
    }

    protected function moncompteAction(){
        View::getView('Coach/moncompte.html');
    }
    
}

?>