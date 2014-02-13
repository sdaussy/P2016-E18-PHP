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

  public function getForm_defi($f3){
   
    $f3->
    $f3->save();

 }
  public function getForm_reponse($f3){
    
  }


 public function getUsers($params){
   $map=$this->getMapper('user');
   return $this->mapper->find(array('Pseudo=?',$params['Pseudo']),array('order'=>'id_User'));
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
  	$map=$this->getMapper('wififav');
  	$favorite=$map->load(array('favId=? and logId=?',$params['favId'],$params['logId']));
  	if(!$favorite){
  		$map->favid=$params['favId'];
  		$map->logId=$params['logId'];
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