<?php

class App_model extends Model{
  
private $mapper;
  
 public function __construct(){
   parent::__construct();
   $this->mapper=$this->getMapper('question');

 } 
 
 public function home(){
  
 }

  public function getForm_defi($f3){
   $defi=$map->load(array('question=? and logId=?',$_POST['nomDefi'],$params['logId']));
   

  }
  public function getForm_reponse($f3){
    
  }


 public function getUsers($params){
   return $this->mapper->find(array('promo=?',$params['promo']),array('order'=>'lastname'));
 }
 
 public function getUser($params){
   return $this->mapper->load(array('userId=?',$params['userId']));
 }
 
 public function searchUsers($params){
 	$query='(firstname like "%'.$params['keywords'].'%" or lastname  like "%'.$params['keywords'].'%")';
 	$query.=$params['filter']?' and promo="'.$params['filter'].'"':'';
 	return $this->mapper->find($query);
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