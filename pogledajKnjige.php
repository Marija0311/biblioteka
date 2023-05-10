<?php
include 'konekcija.php';
include 'model/writer.php';
include 'model/book.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php          
if (isset($_POST['writer'])) {
  $icko = $_POST['writer'];
}
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
</head>

<body class="stranica" style="background-color: #77d9bd ; margin-bottom:100px" >
<nav class="navbar navbar-expand-lg navbar-light" id="navCont" style="height:100px; ">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav p-lg-0 " style="margin-left: 2%; margin-top:10px;   ">
                    <li> <h1 style= "color:white ; margin-top:2px"> Klub citalaca</h1> </li>
                    <li><a id="btn-Pocetna" href="index.php" type="button" class="btn btn-success btn-block" style="margin-left:100px" >
                        Pocetna</a></li>
                    <li><a id="btn-Dodaj" type="button" class="btn btn-success btn-block"  style="margin-left:100px" data-toggle="modal" data-target="#my" >
                        Dodaj novu knjigu </a></li>
                    <li><a id="btn-Prikazi" href="pogledajKnjige.php" type="button" style="margin-left:100px" class="btn btn-success btn-block">
                        Pogledaj knjige</a></li>
                    <li><a id="btn-Pocetna" href="odjava.php" type="button" class="btn btn-success btn-block"  style="margin-left:100px">
                    Odjavi se</a> </li>
                </div>
            </div>
    </nav>

        <div class="modal fade" id="my" role="dialog" >
        <div class="modal-dialog">
            
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="dodajForm">
                            <h3 style="color: #5173ad; text-align: center;font-size:25px">Dodaj novu knjigu</h3>
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label style="color:#5173ad;font-size:18px" for="">Naziv knjige</label>
                                        <input type="text" style="border: 1px solid #A2484F" name="title" class="form-control" />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label style="color:#5173ad ;font-size:18px" for="">Godina</label>
                                        <input type="text" style="border: 1px solid #A2484F " name="god" class="form-control" />
                                        
                                    </div>
                                   
                                    <div class="form-group">
                                        <label style="color:#5173ad;font-size:18px" for="">Mesto izdanja</label>
                                        <input type="text" style="border: 1px solid #A2484F" name="published_in" class="form-control" />
                                    </div>
                                    <div class="form-group" >
                                        <select style="color:#5173ad ;font-size:18px ;font-weight:bold" id="writerid" name="writerid" class="form-control">
                                            <?php
                                            $rez = $conn->query("SELECT * from writer");
                                            while ($red = $rez->fetch_array()) {
                                            ?>
                                                <option  name="value" value="<?php echo $red['writerid'] ?>"> <?php echo $red['name'] ?></option>
                                            <?php  }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button id="btnDodaj"  type="submit" class="btn btn-success btn-block" style="background-color:#a5f0e2  ; color:white ; font-weight:bold; padding-top:10px; font-size:17px">
                                        Dodaj knjigu</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
 
  <div class="container pt">
    <?php
    $niz = [];
    $rez = $conn->query("select * from book b join writer w on b.writerid=w.writerid");
    while ($red = $rez->fetch_array()) {
      $writer = new Writer($red['writerid'], $red['name']);
      $book = new Book($red['bookid'], $red['title'],$red['god'],$red['published_in'], $writer);
      array_push($niz, $book);
    }
    ?>
    <p id="p" style="color:white; font-size:35px">Vase izabrane knjige</p>
    <table class="table table-hover">
      <thead style="font-weight:500px ;background-color:#A2484F; color:white">
        <tr>
          <th>Naziv</th>
          <th>Godina</th>
          <th>Mesto izdanja</th>
          <th>Autor</th>
          <th>Obrisi</th>
          <th>Izmeni</th>
        </tr>
      </thead>
      <tbody style="color:#A2484F; font-size:20px ">
        <?php
        foreach ($niz as $vrednost) {
        ?>
          <tr>
            <td style="display:none" data-target="writerid"><?php echo $vrednost->writerid->name?></td> 
            <td data-target="title"><?php echo $vrednost->title ?> </td>
            <td data-target="god"><?php echo $vrednost->god ?> </td>
            <td data-target="published_in"><?php echo $vrednost->published_in ?> </td>
            <td data-target="writerid"><?php echo $vrednost->writerid->name ?></td>
            <td><button id="btnObrisi" name="btnObrisi" class="btn btn-danger" style="background-color:#A2484F ; color:white ; font-weight:bold; padding-top:10px; font-size:17px"
            data-id1="<?php echo $vrednost->bookid ?>">Obrisi</a></td>
            <td><button class="btn btn-info" data-toggle="modal" style="background-color:#CB918D ; color:white ; font-weight:bold; padding-top:10px; font-size:17px"
            data-target="#my1" data-id2="<?php echo $vrednost->bookid ?>">Izmeni</a></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

  </div>

<!--kartica za izmenu -->
<div class="modal fade" id="my1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="container prijava-form">
            <form action="#" method="post" id="izmeniForma">


              <h3 style="color: #A2484F; text-align: center;font-size:25px">Izmeni podatke o knjizi</h3>
              <div class="row">
                <div class="col-md-11 ">

                  <div style="display: none;" class="form-group">
                    <label for="">bookid</label>
                    <input  id="bookid" type="text" style="border: 1px solid #A2484F" name="bookid" class="form-control" />
                  </div>

                  <div class="form-group" style="display: none;">
                    <label style="color:#EFB9AD;font-size:18px" for="">writerid</label>
                    <input id="writerid"  type="text" style="border: 1px solid #A2484F" name="writer" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label style="color:#EFB9AD;font-size:18px" for="">Naziv knjige</label>
                    <input id="title" type="text" style="border: 1px solid #A2484F" name="title" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label style="color:#EFB9AD;font-size:18px" for="">Godina</label>
                    <input id="god" type="text" style="border: 1px solid #A2484F" name="god" class="form-control" />
                  </div>
                 
                  <div class="form-group">
                    
                    <button id="btnIzmeni" type="submit" class="btn btn-success btn-block" style="background-color:#EFB9AD ; color:white ; font-weight:bold; padding-top:10px; font-size:17px">
                    Izmeni</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>

  </div>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    
    
</body>

</html>