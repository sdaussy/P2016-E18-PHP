<?php

class User_controller extends Controller{

  public function __construct(){
    parent::__construct();
    //instanciation du constructeur de la classe mère
    $this->tpl=array('sync'=>'main.html');
    //template sync

  }

  /*Permet la connexion de l'utilisateur à son compte
    route : /login
    redirection : reroute vers défi
  */
	public function login($f3){
    $pass=hash('sha256',$f3->get('POST.pswd_user'));
	    switch($f3->get('VERB')){
	      case 'GET':
	        $this->tpl['sync']='login.html';
	      break;
	      case 'POST':
	        $auth=$this->model->login(array(
	          'login'=>$f3->get('POST.pseudo_user'),
	          'password'=>$pass
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
  /*Permet à l'utilisateur de se déconnecter 
    route : /logout
    redirection : reroute vers la home
  */
  public function logout($f3){
    session_destroy();
    $f3->reroute('/');
  }

  /*Permet l'inscription d'un utilisateur 
    route : /signin
    template : signin.html
  */
  public function signin($f3){
    $pass=hash('sha256',$f3->get('POST.pswd_user'));
   	$donnees=$this->model->signin(array(
      'Pseudo'=>$f3->get('POST.pseudo_user'),
      'password'=>$pass,
      'Email'=>$f3->get('POST.mail_user')
      ),$f3);
    $this->tpl['sync']='signin.html';
    
  }

   /*Permet de récupérer le profil d'un utilisateur 
    route : /profil
    template : profil.html
  */
  public function getProfil($f3){
     /* Permet de récupérer le profil d'un utilisateur  */
  	$donnees=$this->model->get_Profil(array(
      'id'=>$f3->get('SESSION.id'),
      'id_User'=>$f3->get('PARAMS.id_User'),
      'Pseudo'=>$f3->get('PARAMS.Pseudo'),
      'Email'=>$f3->get('PARAMS.Email'),
      'img_Profil'=>$f3->get('PARAMS.img_Profil'),
      'Niveau'=>$f3->get('PARAMS.Niveau')
      ));
    $f3->set('datas_profil', $donnees);
    /* Permet de récupérer le fichier envoyé  */
    switch($f3->get('VERB')){
      case 'POST':
        \Web::instance()->receive(function($file) use ($f3){
          $monfichier=$file['name'];
         $f3->set('monimgprofil',$monfichier);
        },true,true);
      break;
    }
    /* Permet de récupérer l'image de profil updaté de l'utilisateur  */
    $donnees2=$this->model->getImg_profil(array(
      'id_User'=>$f3->get('SESSION.id'),
      'img_Profil'=>$f3->get('monimgprofil')
      ));
    $f3->set('img_profil', $donnees2);
    
    $this->tpl['sync']='profil.html';
  }
}

 /* Test pour l'autocomplete du champ ami pour l'envoi d'un défi
 public function searchUsers($f3){
    $f3->set('users',$this->model->searchUsers(array(
      'keywords'=>$f3->get('POST.data')
      ))
    );
    $this->tpl['async']='partials/users.html';
   

  }*/
 ?>