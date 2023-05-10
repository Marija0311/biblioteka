<?php

include "konekcija.php";
require "model/administrator.php";

session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $administrator = new Administrator(1, $username, $password);
    $admin = Administrator::login($administrator, $conn);

    if($admin->num_rows==1){
        $_SESSION['admin'] = $administrator->username;
        setcookie("admin", $username, time() + 3600);
        header('Location: index.php');
        exit();
    }else{
        echo '<script type="text/javascript">
               window.onload = function () { alert("Pogrešni kredencijali! Pokušajte ponovo"); } 
              </script>'; 
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Biblioteka online</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">

</head>

<body class="pozadinaLogin">
    <div class="login-form">
        <div class="main-div">
            <div class="container" style="margin-top: 20px; margin-bottom: -50px; ">
                <div class="row">
                    <div class="col-lg-4 offset-lg-4 text-center">
                        <div class="section-heading">
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" action="">
                <br><br><br><br>
                <br>
                <div class="container" style="width: 30%; margin: auto;">
                    <br>

                    <label for="username" style="background-color:pink">Korisničko ime</label>
                    <input type="text" name="username" class="form-control" required>
                    <br>

                    <label  for="password" style="background-color:pink">Lozinka</label>
                    <input type="password" name="password"  class="form-control" required>
                    <br>

                    <button type="submit" class="btn btn-primary" style="background-color: #A2484F; width: 80%; margin-left: 10%; margin-top:5%; border: 1px #80da62;" name="submit">Uloguj se</button>
                    <br><br>
                </div>
            </form>
        </div>
    </div>

    <br>

</body>
</html>