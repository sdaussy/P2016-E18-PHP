<?php

class App_model extends Model{
  
private $mapper;
  
 public function __construct(){
   parent::__construct();
   $this->mapper=$this->getMapper('question');

 } 
  public function signin($params){
    if(isset($params['login']) && isset($params['password'])){
      $map=$this->getMapper('user');
      return $map->load(array('Pseudo=? and Mdp=?',$params['login'], $params['password']));
    }
  }
 
 public function home(){
  
 }

  public function getDefi($f3){

  }

  public function getReponse($f3){

  }

  public function getForm_defi($params){ 
    $form=$this->getMapper('question');
    $form->nomDefi=$params['nomDefi'];
    $form->Question=$params['Question'];
    $form->Reponse=$params['Reponse'];
    $form->id_User=$params['id_User'];
    $form->id_Cat=$params['id_Cat'];
    $form->save();

 }
  public function getForm_reponse($f3){
    
  }

  public function getUsersClassement($params){
    $map=$this->getMapper('user');
   return $map->find(null,array('order'=>'Niveau DESC'));
 
  }
 public function getUsers($params){
   $map=$this->getMapper('user');
   return $map->find(array('Pseudo=?',$params['Pseudo']),array('order'=>'id_User'));
   // trouve dans promo la data promo passée en param ordonnée par lastname 
 }
 
 public function getUser($params){
   return $this->mapper->load(array('userId=?',$params['userId']));
   //trouve dans userID où il est = au user id en params
 }
 
 public function searchUsers($params){
  $map=$this->getMapper('user');
 	$query='(Pseudo like "%'.$params['keywords'].'%")';
 	$query.=$params['filter']?' and Pseudo="'.$params['filter'].'"':'';
 	return $map->find($query);
 }
  
  public function favorite ($params){
  	$map=$this->getMapper('favoris');
  	$favorite=$map->load(array('fav_Id=? and id_User=?',$params['favId'],$params['idUser']));
  	if(!$favorite){
  		$map->fav_Id=$params['favId'];
  		$map->id_User=$params['idUser'];
  		$map->save();
  		return true;
  	}
  	else{
  		$favorite->erase();
  		return false;
  		//update
  	}
  }
  
  
}

?>