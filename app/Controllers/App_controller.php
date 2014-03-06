<?php

class App_controller extends Controller{

  public function __construct(){
    parent::__construct();
    //instanciation du constructeur de la classe mère
    $this->tpl=array('sync'=>'main.html');
    //template sync
  }
  
  
  public function home($f3){
    $this->tpl['sync']='main.html';
  }

  public function getDefi($f3){
      $donnees1=$this->model->getCats(array('id_Cat'=>$f3->get('PARAMS.id_Cat'),'nom_Cat'=>$f3->get('PARAMS.nom_Cat')));
      $f3->set('lescats', $donnees1);

      $donnees=$this->model->getDefigagne(array('Pseudo'=>$f3->get('PARAMS.Pseudo'),'nomDefi'=>$f3->get('PARAMS.nomDefi'),'Question'=>$f3->get('PARAMS.Question'),'Image'=>$f3->get('PARAMS.Image'),'id_User'=>$f3->get('PARAMS.id_User'),'Reponse_User2'=>$f3->get('PARAMS.Reponse_User2'),'Reponse'=>$f3->get('PARAMS.Reponse'),'id'=>$f3->get('SESSION.id')));
      $f3->set('defi_gagne', $donnees);

      $modelName='User_model';
      $this->model=new $modelName();
      $donnees2=$this->model->getUsers(array('id_User'=>$f3->get('PARAMS.id_User'),'Pseudo'=>$f3->get('PARAMS.Pseudo')));
      $f3->set('lesusers', $donnees2); 
         
    $this->tpl['sync']='defi.html';
  }
  /*public function getDefigagne($f3){
    $donnees=$this->model->getDefigagne(array('Pseudo'=>$f3->get('PARAMS.Pseudo'),'nomDefi'=>$f3->get('PARAMS.nomDefi'),'Question'=>$f3->get('PARAMS.Question'),'Image'=>$f3->get('PARAMS.Image'),'id_User'=>$f3->get('PARAMS.id_User'),'Reponse_User2'=>$f3->get('PARAMS.Reponse_User2'),'Reponse'=>$f3->get('PARAMS.Reponse'),'id'=>$f3->get('SESSION.id')));
    $f3->set('defi_gagne', $donnees);
    $this->tpl['sync']='defi.html';
  }*/

  public function getReponse($f3){   
    $donnees=$this->model->getReponse(array('id_Question'=>$f3->get('PARAMS.id_Question'),'Image'=>$f3->get('PARAMS.Image'),'Pseudo'=>$f3->get('PARAMS.Pseudo'),'Question'=>$f3->get('PARAMS.Question'),'Message'=>$f3->get('PARAMS.Message'),'nomDefi'=>$f3->get('PARAMS.nomDefi'),'id_User'=>$f3->get('SESSION.id'),'Reponse_User2'=>$f3->get('PARAMS.Reponse_User2')));
    $f3->set('liste_reponse', $donnees);
    $this->tpl['sync']='reponse.html';
  }
  public function getMareponse($f3){ 
    $donnees=$this->model->getMa_reponse(array('monid_Question'=>$f3->get('POST.id_question'),'id_Question'=>$f3->get('PARAMS.id_Question'),'Image'=>$f3->get('PARAMS.Image'),'Pseudo'=>$f3->get('PARAMS.Pseudo'),'Question'=>$f3->get('PARAMS.Question'),'Message'=>$f3->get('PARAMS.Message'),'nomDefi'=>$f3->get('PARAMS.nomDefi'),'id_User'=>$f3->get('SESSION.id'),'Reponse_User2'=>$f3->get('PARAMS.Reponse_User2')));
    $f3->set('single_reponse', $donnees);

    $donnees2=$this->model->setReponse(array(
        'id_Question'=>$f3->get('POST.id_question'),
        'rep'=>$f3->get('POST.nomreponse')
        ));
    $f3->set('marep', $donnees2);  
      
    $donnees3=$this->model->getSolution(array(
        'Reponse'=>$f3->get('PARAMS.Reponse'),
        'Reponse_User2'=>$f3->get('PARAMS.Reponse_User2')
        ));
    $f3->set('solution', $donnees3);
    $this->tpl['sync']='single_reponse.html';
  }

  public function getForm_defi($f3){
    switch($f3->get('VERB')){
      case 'POST':
        \Web::instance()->receive(function($file) use ($f3){
          $monfichier=$file['name'];
         $f3->set('monfichier',$monfichier);
        //$file->resize(300,400);
        },true,true);
       

        /*\Web::instance()->receive(function($file){
              $file['name']=$file['name']."_20";              
              $petite_img = new Image($file['name'],true);
              $petite_img->resize(10,20,true,true);
              $petite_img->save();
        },true,true);*/
      break;
    }
   $this->model->getForm_defi(array('id_User2'=>$f3->get('POST.a_qui'),'nomDefi'=>$f3->get('POST.nom_defi'),'Question'=>$f3->get('POST.question'),'Reponse'=>$f3->get('POST.reponse_voulue'),'id_User'=>$f3->get('SESSION.id'),'Pseudo'=>$f3->get('SESSION.Pseudo'),'id_Cat'=>$f3->get('POST.categories'),'Message'=>$f3->get('POST.msg_perso'),'Image'=>$f3->get('monfichier')));
   $f3->reroute('/defi');
  }
  public function getForm_reponse($f3){
  
  }
  public function getUsersClassement($f3){
    $donnees=$this->model->getUsersClassement(array('Pseudo'=>$f3->get('PARAMS.Pseudo'),'Niveau'=>$f3->get('PARAMS.Niveau')));
    $f3->set('usersClassement', $donnees);
     
  }
 
  public function getUser($f3){
    $f3->set('user',$this->model->getUser(array('Id_User'=>$f3->get('PARAMS.Id_User'))));
    $this->tpl['async']='partials/user.html';
  }
  
   
  public function favorite($f3){
    $status=$this->model->favorite(array('favId'=>$f3->get('PARAMS.favId'),'Id_User'=>1));
    echo json_encode(array('status'=>$status));
    exit;
  }
  

}

?>