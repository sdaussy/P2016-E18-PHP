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
 
 public function signin($params,$f3){
    if(isset($params['Pseudo']) && isset($params['password']) && isset($params['Email'])){
    	$mesusers=$this->dB->exec('SELECT Pseudo FROM user WHERE Pseudo = :truc',array(':truc'=>$params['Pseudo']));
    	if($mesusers==NULL){		
	      $form=$this->getMapper('user');
			$form->Pseudo=$params['Pseudo'];
			$form->Mdp=$params['password'];
			$form->Email=$params['Email'];
			$form->save();
			$f3->set('success',$f3->get('creationcompteSuccess'));
		}
		else{
			$f3->set('error',$f3->get('pseudoError'));
		}
    }

}
public function searchUsers($params){
  $map=$this->getMapper('user');
 	//$query='(Pseudo like "%'.$params['keywords'].'%")';
 	//$query=array('Pseudo like "%'.$params['keywords'].'%"'),array('order'=>'ASC');
 	//$query.=$params['filter']?' and Pseudo="'.$params['filter'].'"':'';
 	return $map->find(array('Pseudo like "%'.$params['keywords'].'%"'));
 	//return json_encode($map);
 }
  public function getUsers($params){
   //$map=$this->getMapper('user');
   return $lesusers=$this->dB->exec('SELECT id_User, Pseudo FROM user');
 }

 public function getProfil($params){
  //$map=$this->getMapper('user');
  return $mesdatas=$this->dB->exec('SELECT id_User, Pseudo, Email, img_Profil, Niveau FROM user WHERE id_User = :truc', array(':truc'=>$params['id']));
 }
 public function getImg_profil($params){
    $map=$this->getMapper('user');
    $map->load(array('id_User=? ',$params['id']));
    $map->img_Profil=$params['img_Profil'];
    $map->update();

 }

  
}

?>