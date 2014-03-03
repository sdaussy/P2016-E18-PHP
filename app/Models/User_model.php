<?php

class User_model extends Model{
  
private $mapper;
  
 public function __construct(){
   parent::__construct();
   $this->mapper=$this->getMapper('question');

 } 
 
 public function login($params){
    if(isset($params['login']) && isset($params['password'])){
      $map=$this->getMapper('user');
      return $map->load(array('Pseudo=? and Mdp=?',$params['login'], $params['password']));
    }
  }
 
 public function signin($params){
    

}
public function searchUsers($params){
  $map=$this->getMapper('user');
 	//$query='(Pseudo like "%'.$params['keywords'].'%")';
 	$query=array('Pseudo like "%'.$params['keywords'].'%"'),array('order'=>'ASC');
 	//$query.=$params['filter']?' and Pseudo="'.$params['filter'].'"':'';
 	return $map->find($query);
 }

  
}

?>