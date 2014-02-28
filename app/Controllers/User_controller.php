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
  	$donnees=$this->model->getReponse();
    $this->tpl['sync']='signin.html';

  }
}

 ?>