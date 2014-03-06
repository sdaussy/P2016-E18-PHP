<?php

class User_controller extends Controller{

  public function __construct(){
    parent::__construct();
    //instanciation du constructeur de la classe mère
    $this->tpl=array('sync'=>'main.html');
    //template sync

  }


	public function login($f3){
	    switch($f3->get('VERB')){
	      case 'GET':
	        $this->tpl['sync']='login.html';
	      break;
	      case 'POST':
	        $auth=$this->model->login(array(
	          'login'=>$f3->get('POST.pseudo_user'),
	          'password'=>$f3->get('POST.pswd_user')
	        ));
	        if(!$auth){
	          $f3->set('error',$f3->get('loginError'));
	          $this->tpl['sync']='login.html';
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
  
  public function logout($f3){
    session_destroy();
    $f3->reroute('/');
  }

  public function signin($f3){
   	$donnees=$this->model->signin(array('Pseudo'=>$f3->get('POST.pseudo_user'),'password'=>$f3->get('POST.pswd_user'),'Email'=>$f3->get('POST.mail_user')),$f3);
    $this->tpl['sync']='signin.html';
    
  }
   public function searchUsers($f3){
    $f3->set('users',$this->model->searchUsers(array('keywords'=>$f3->get('POST.data'))));
    $this->tpl['async']='partials/users.html';
   

  }
   public function getUsers($f3){
    $donnees=$this->model->getUsers(array('id_User'=>$f3->get('PARAMS.id_User'),'Pseudo'=>$f3->get('PARAMS.Pseudo')));
    $f3->set('lesusers', $donnees);
    $this->tpl['sync']='defi.html';
  }
  public function getProfil($f3){
  	$donnees=$this->model->getProfil(array('id'=>$f3->get('SESSION.id'),'id_User'=>$f3->get('PARAMS.id_User'),'Pseudo'=>$f3->get('PARAMS.Pseudo'),'Email'=>$f3->get('PARAMS.Email'),'img_Profil'=>$f3->get('PARAMS.img_Profil'),'Niveau'=>$f3->get('PARAMS.Niveau')));
    $f3->set('datas_profil', $donnees);
    
    switch($f3->get('VERB')){
      case 'POST':
        \Web::instance()->receive(function($file) use ($f3){
          $monfichier=$file['name'];
         $f3->set('monfichier',$monfichier);
        },true,true);
      break;
    }
    $donnees2=$this->model->getImg_profil(array('img_Profil'=>$f3->get('monfichier'),'id'=>$f3->get('SESSION.id')));
    $f3->set('img_profil', $donnees2);
    $this->tpl['sync']='profil.html';
  }
}

 ?>