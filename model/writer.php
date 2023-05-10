<?php

class Writer{
  public $writerid;
  public $name;
 
  
  function __construct($writerid=null,$name=null) {
        $this->writerid = $writerid;
        $this->name = $name;
        
    }
   
}
?>