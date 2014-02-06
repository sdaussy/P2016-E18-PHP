<?php

class App_controller extends Controller{

  public function __construct(){
    parent::__construct();
    //instanciation du constructeur de la classe mère
    $this->tpl=array('sync'=>'defi.html');
    //template sync

  }
  
  public function home($f3){
    
  }

  public function getForm_defi($f3){
    $f3->set('envoiDefi',$this->model->getForm_defi(array('envoi_defi'=>$f3->get('POST.envoi_defi'))));
    //if(isset($f3->get('envoiDefi'))){
      $f3->set('nomDefi',$this->model->getForm_defi(array('nom_defi'=>$f3->get('POST.nom_defi'))));
      $f3->set('reponseVoulue',$this->model->getForm_defi(array('reponse_voulue'=>$f3->get('POST.reponse_voulue'))));
      $f3->set('users',$this->model->getForm_defi(array('msg_perso'=>$f3->get('POST.msg_perso'))));
      $f3->set('users',$this->model->getForm_defi(array('nom_defi'=>$f3->get('POST.nom_defi'))));
 //  }
      
    

  }
  public function getForm_reponse($f3){
  
  }
  
  public function getUsers($f3){

    $f3->set('users',$this->model->getUsers(array('promo'=>$f3->get('PARAMS.promo'))));
    $this->tpl['async']='partials/users.html';
  }
  
  public function getUser($f3){
    $f3->set('user',$this->model->getUser(array('userId'=>$f3->get('PARAMS.userId'))));
    $this->tpl['async']='partials/user.html';
  }
  
  public function searchUsers($f3){
    $f3->set('users',$this->model->searchUsers(array('keywords'=>$f3->get('POST.name'),'filter'=>$f3->get('POST.filter'))));
    $this->tpl['async']='partials/users.html';
  }
  
  public function favorite($f3){
    $status=$this->model->favorite(array('favId'=>$f3->get('PARAMS.favId'),'logId'=>1));
    echo json_encode(array('status'=>$status));
    exit;
  }
  

  

}

?>