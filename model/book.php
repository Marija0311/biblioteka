<?php


class Book{
  public $bookid;
  public $title;
  public $god;
  public $published_in;
  public $writerid;

  function __construct($bookid=null,$title=null,$god=null,$published_in=null,$writerid=null) {
        $this->bookid = $bookid;
        $this->title = $title;
        $this->god = $god;
        $this->published_in=$published_in;
        $this->writerid = $writerid;
    }

    public function insert($conn){
      return $conn->query("INSERT INTO book(title,god,published_in,writerid) VALUES ('$this->title','$this->god','$this->published_in','$this->writerid')");
      
  }

  public function delete($conn,$id){
    return $conn->query("DELETE FROM book where bookid=$id");
  }

  public function update($conn){
    return $conn->query("UPDATE book SET title='$this->title',god='$this->god'  where bookid=$this->bookid");
}

public static function getById($id, $conn){
  return $conn->query("SELECT * FROM book WHERE bookid = $id");
}


}

?>