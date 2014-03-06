<?php

class App_model extends Model{
  
private $mapper;
  
 public function __construct(){
   parent::__construct();
   $this->mapper=$this->getMapper('question');

 } 
  
 
 public function home(){
  
 }

  public function getDefi($f3){

  }   
  public function getDefigagne($params){
    return $defi_gagne=$this->dB->exec('SELECT Pseudo, nomDefi, Question, Image, id_User, Reponse, Reponse_User2 FROM question WHERE id_User = :truc and Reponse_User2 = :machin',array(':truc'=>$params['id'], ':machin'=>$params['Reponse']));
  }
  public function getReponse($params){
     //$liste_reponse=$this->getMapper('question');
    return $liste_reponse=$this->dB->exec('SELECT id_Question, Image, Pseudo, Question, nomDefi, Message, id_User2, Reponse_User2 FROM question WHERE id_User2 = :truc and Reponse_User2 = :machin',array(':truc'=>$params['id_User'], ':machin'=>''));
    //return $liste_reponse->load(array('Question and nomDefi and Message and id_User2=?',$params['id_User']));
  
  }
   public function getMa_reponse($params){ 
   return $ma_reponse=$this->dB->exec('SELECT id_Question, Image, Pseudo, Question, nomDefi, Message, id_User2, Reponse_User2 FROM question WHERE id_User2 = :truc and Reponse_User2 LIKE :machin and id_Question = :chose',array(':truc'=>$params['id_User'], ':machin'=>'',':chose'=>$params['monid_Question']));
   
  }
  public function setReponse($params){     
    $form=$this->getMapper('question');
    $form->load(array('id_Question=? ',$params['id_Question']));
    $form->Reponse_User2=$params['rep'];
    $form->update();

  }
  public function setSolution($params){

  }
  public function getSolution($params){
    $map=$this->getMapper('question');
    $map->load(array('Reponse=? and Reponse_User2=?',$params['Reponse'],$params['Reponse_User2']));
    if($map!=null){
      $map2=$this->getMapper('id_Cat');
    }
    return $gagne_perdu=$this->dB->exec('SELECT Reponse_User2, Reponse FROM question WHERE Reponse');
  }

  public function getForm_defi($params){ 
    $form=$this->getMapper('question');
    $form->id_User2=$params['id_User2'];
    $form->nomDefi=$params['nomDefi'];
    $form->Question=$params['Question'];
    $form->Reponse=$params['Reponse'];
    $form->id_User=$params['id_User'];
    $form->Pseudo=$params['Pseudo'];
    $form->id_Cat=$params['id_Cat'];
    $form->Message=$params['Message'];
    $form->Image=$params['Image'];
    $form->save();

 }
  public function getForm_reponse($f3){
    
  }

  public function getUsersClassement($params){
    $map=$this->getMapper('user');
   return $map->find(null,array('order'=>'Niveau DESC','limit'=>5));
 
  }

   public function getCats($params){
   return $lescats=$this->dB->exec('SELECT id_Cat, nom_Cat FROM categories');
 }

 
 public function getUser($params){
   return $this->mapper->load(array('userId=?',$params['userId']));
   //trouve dans userID où il est = au user id en params
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