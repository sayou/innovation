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
        if($id = filter_input(INPUT_POST,'id')){
            $datas = Projet::getEtatAvancement(10);
            $countdata = Projet::getCountEtatAvancement(10);
            echo '<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>L\'etat d\'avencement<small>Progression hebdomadaire</small></h2>
                
                <div class="clearfix"></div>
                </div>';
                if($countdata > 0){
                    foreach($datas as $data){
                        echo '
                <div>
                  <div class="clearfix"></div>
                    <p>'.$data['date'].' | '.$data['etat'].' %</p>
                    <div class="">
                      <div class="progress progress_sm" style="width: 100%;">
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="'.$data['etat'].'"></div>
                      </div>
                    </div>
                </div>';
                    }
                }else{
                    echo '
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Ooops</strong> No data found.
                  </div>
                    
                <div class="clearfix"></div>
              </div>
            </div>
        </div>';
                }
                
                  
        }
        else{
            $allproject = Projet::getProjetDataByCoach(8);
        View::getView('Coach/mesprojets.html',["projects"=>$allproject,"datas"=>$datas,"countdata"=>$countdata]);
        }
        
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
                $result = Projet::deleteCoachFromProject($id,2);
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
    
}

?>