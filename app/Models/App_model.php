<?php
class App_model{
  
 function __construct(){
  
 } 
 
 function home(){
  
 }
 
 function getUsers($f3,$params){
   $users=new DB\SQL\Mapper($f3->get('dB'),'wifiloc');
   return $users->find('firstname like "'.$params['alpha'].'%"');
   //notre M  renvoie la donnée au C
 }
 
 function getUser($f3,$params){
   $user=new DB\SQL\Mapper($f3->get('dB'),'wifiloc');
   return $user->load('userId="'.$params['userId'].'"');
   //dans users on stocke find récupère 1 élement, load plusieurs éléments
 }
 
 function searchUsers($f3,$params){
   $user=new DB\SQL\Mapper($f3->get('dB'),'wifiloc');
   return $user->find('firstname like "%'.$params['keywords'].'%" or lastname  like "%'.$params['keywords'].'%"');
 }  
  
  
}

?>