<?php
 require '../konekcija.php';
 require '../model/book.php';
 require '../model/writer.php';


 if(isset($_POST['bookid'])&&   isset($_POST['writer'])&& isset($_POST['title']) && isset($_POST['god']) ){
  $bookid=$_POST['bookid'];
 
  $title=$_POST['title'];
  $god=$_POST['god'];
 


  $book=new Book($bookid,$title,$god);
  $rezultat=$book->update($conn);
  
  if($rezultat){
    echo 'Ok';
 }else{ 
   echo 'No';
   echo $status;
 }
 } 
  ?>