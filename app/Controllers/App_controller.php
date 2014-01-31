<?php
class App_controller{

  function __construct()
  {
    
  }
  
  function home($f3){
    echo View::instance()->render('defi.html');
  }
  
  function getUsers($f3){
    $model= new App_model();
    $f3->set('users',$model->getUsers($f3,array('alpha'=>$f3->get('PARAMS.alpha'))));
    //appelle la fonction au sein du controlleur et lui passe f3 set et récupère la variable userss du M
    if($f3->get('AJAX')){
      echo View::instance()->render('partials/users.html');
    }
    else{
      echo View::instance()->render('main.html');
    }
  }
  
  function getUser($f3){
    $model= new App_model();
    //instancie le modele
    $f3->set('user',$model->getUser($f3,array('userId'=>$f3->get('PARAMS.userId'))));
    if($f3->get('AJAX')){
      echo View::instance()->render('partials/user.html');
    }
    else{
      echo View::instance()->render('main.html');
    }
  }
  
  function searchUsers($f3){
    $model = new App_model();
    $f3->set('users',$model->searchUsers($f3,array('keywords'=>$f3->get('POST.name'))));
    //echo $f3->get('dB')->log();
    if($f3->get('AJAX')){
      echo View::instance()->render('partials/users.html');
    }
    else{
      echo View::instance()->render('main.html');
    }
  }
  
  
  
}

?>