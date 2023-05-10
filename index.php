<?php
include 'konekcija.php';
include 'model/book.php';
include 'model/writer.php';


session_start();

$user="";

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
if (isset($_COOKIE["admin"]))
    {
        $user=$_COOKIE["admin"];
    }
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klub citalaca</title>

    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

    <link href="css/main.css" rel="stylesheet">
</head>

<body class="stranica" style="background-color: #77d9bd ; margin-bottom:100px">
   
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

        <div id="ww"style="background-color:#a5f0e2" >
        <div class="container"style="background-color: none" >
            <div class="row">
                <div class="deoslika" style="background-color: #77d9bd; margin-top:40px ; width: 1170px;">
                    <img src="https://e0.pxfuel.com/wallpapers/575/224/desktop-wallpaper-books-library-shelves-lighting-library-aesthetic.jpg" alt="pocetna" class="slikaPocetna"
                    style="width: 1170px; height:550px; align:center">
                    <h2 style="color:white ; text-align: center; padding-bottom:18px ;width: 1170px;">  A room without books is like a body without a soul</h2>
                </div>
            </div>
            <h4>Poštovani čitaoci, <br>
Dobrodošli u svoj lični klub knjiga! Strast za čitanjem je ukorenjena u meni od malena. Jedno od mojih omiljenih pitanja koje stalno dobijam od svojih prijatelja jeste šta su knjige ili autori doprineli mom unutrašnjem rastu. <br> Tako sam uzbuđena što konačno stvaram i pozivam vas sve da se pridružite i učestvujete u klubu knjizevnika!</h4>
        </div>
    </div>

    <div class="modal fade" id="my" role="dialog" >
        <div class="modal-dialog">
            
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="dodajForm">
                            <h3 style="color: #5173ad;position:relative; text-align: center;font-size:25px">Dodaj novu knjigu</h3>
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
                                    <label style="color:#5173ad;font-size:18px" for="">Autor</label>
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
                                        <button id="btnDodaj"  type="submit" class="btn btn-success btn-block" style="background-color:#a5f0e2 ; color:white ; font-weight:bold; padding-top:10px; font-size:17px">
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

    <div class="container pt" style="margin-top:50px">
    <div id="searchDiv" >
        <label for="pretraga"style="color:white;font-weight:400px ;font-size:25px">Pretraži knjigu po autoru</label>
        <select id="pretraga" onchange="pretraga()" class="form-control" style="color:#a5f0e2; font-weight:bold ;font-size:20px ;" >
            <?php
            $rez = $conn->query("SELECT * from writer");
            while ($red = $rez->fetch_assoc()) {
            ?>
                <option style="color:#a5f0e2; font-weight:bold ;font-size:20px ;" 
                value="<?php echo $red['writerid'] ?>"> <?php echo $red['name'] ?></option>
            <?php   }
            ?>
        </select>
    </div>


    <div id="podaciPretraga"style="font-weight:bold ;font-size:20px ; margin-top:-80px" ></div>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function pretraga() {
            $.ajax({
                url: "handler/pretraga.php",
                data: {
                    writerid: $("#pretraga").val()
                },
                success: function(html) {
                    $("#podaciPretraga").html(html);
                }
            })
        }
    </script>



</body>