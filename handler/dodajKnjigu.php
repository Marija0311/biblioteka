<?php
 require '../konekcija.php';
 require '../model/book.php';


 if(isset($_POST['title']) && isset($_POST['god']) && isset($_POST['published_in'])&&isset($_POST['writerid']) ){
  $book = new Book(null,$_POST['title'],$_POST['god'],($_POST['published_in']),$_POST['writerid']);
  $rez=$book->insert($conn);
  
  if($rez){ 
    echo 'Ok';
 }else{ 
   echo 'No';
 }
 } 
  ?>