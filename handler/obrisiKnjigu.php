<?php
require '../konekcija.php';
require '../model/book.php';

    $id =$_POST['id'];  
    $book = new Book($id,null,null,null);
    if($book->delete($conn,$id)){
      echo "Ok";
    }else{
      echo "No";
    }
 ?>