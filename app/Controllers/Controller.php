<?php

class Controller{
  
protected $tpl;
protected $model;

  protected function __construct(){
    
    $f3=\Base::instance();
    if(($f3->get('PATTERN')=='/defi' OR $f3->get('PATTERN')=='/reponse' OR $f3->get('PATTERN')=='/reponse/unereponse') &&!$f3->get('SESSION.id')){
      $f3->reroute('/signin');  
    }
    elseif($f3->get('PATTERN')!='/login' &&!$f3->get('SESSION.id')){
      //$f3->reroute('/signin');
    }
    
    $modelName=substr(get_class($this),0,strpos(get_class($this),'_')+1).'model';
    if(class_exists($modelName)){
      $this->model=new $modelName();
    } 
  
   
  }
  
  public function afterroute($f3){
    if($f3->get('AJAX')){
      echo View::instance()->render($this->tpl['async']);
    }else{
      echo View::instance()->render($this->tpl['sync']);
    } 
  }
}
?>

