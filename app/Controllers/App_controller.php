<?php

class App_controller extends Controller{

  public function __construct(){
    parent::__construct();
    //instanciation du constructeur de la classe mère
    $this->tpl=array('sync'=>'main.html');
    //template sync

  }
  public function signin($f3){
    switch($f3->get('VERB')){
      case 'GET':
        $this->tpl['sync']='signin.html';
      break;
      case 'POST':
        $auth=$this->model->signin(array(
          'login'=>$f3->get('POST.pseudo_user'),
          'password'=>$f3->get('POST.pswd_user')
        ));
        if(!$auth){
          $f3->set('error',$f3->get('loginError'));
          $this->tpl['sync']='signin.html';
        }
        else{
          $user=array(
            'id'=>$auth->id_User,
            'Pseudo'=>$auth->Pseudo,
            'Email'=>$auth->Email,
            'imgProfil'=>$auth->img_Profil
          );
          $f3->set('SESSION',$user);
          $f3->reroute('/defi');
        }
      break;
    }
  }
  
  public function signout($f3){
    session_destroy();
    $f3->reroute('/');
  }
  
  public function home($f3){
    $this->tpl['sync']='main.html';
  }

  public function getDefi($f3){
    $this->tpl['sync']='defi.html';
  }

  public function getReponse($f3){
    $this->tpl['sync']='reponse.html';
  }

  public function getForm_defi($f3){
    $this->model->getForm_defi(array('nomDefi'=>$f3->get('POST.nom_defi'),'Question'=>$f3->get('POST.question'),'Reponse'=>$f3->get('POST.reponse_voulue'),'id_User'=>$f3->get('SESSION.id'),'id_Cat'=>$f3->get('POST.categories')));
    $f3->reroute('/defi');
  }
  public function getForm_reponse($f3){
  
  }
  public function getUsersClassement($f3){
    $donnees=$this->model->getUsersClassement(array('Pseudo'=>$f3->get('PARAMS.Pseudo'),'Niveau'=>$f3->get('PARAMS.Niveau')));
    $f3->set('usersClassement', $donnees);
     
  }
  public function getUsers($f3){
    $donneesRecues = $this->model->getUsers(array('Pseudo'=>$f3->get('PARAMS.Pseudo')));
    $f3->set('users', $donneesRecues);
    $this->tpl['async']='partials/users.html';
  }
  
  public function getUser($f3){
    $f3->set('user',$this->model->getUser(array('Id_User'=>$f3->get('PARAMS.Id_User'))));
    $this->tpl['async']='partials/user.html';
  }
  
  public function searchUsers($f3){
    $f3->set('users',$this->model->searchUsers(array('keywords'=>$f3->get('POST.pseudo'),'filter'=>$f3->get('POST.filter'))));
    $this->tpl['async']='partials/users.html';
  }
  
  public function favorite($f3){
    $status=$this->model->favorite(array('favId'=>$f3->get('PARAMS.favId'),'Id_User'=>1));
    echo json_encode(array('status'=>$status));
    exit;
  }
  
  public function upload($f3){
    $this->tpl['sync']='upload.html';
    switch($f3->get('VERB')){
      case 'POST':
        \Web::instance()->receive(function($file){
           $this->tpl['sync']='defi.html';
        },true,true);
      break;
    }
  }

  

}

?>