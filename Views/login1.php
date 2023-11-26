<?php 
require '../Modelos/Database.php';
require '../Modelos/config.php';
require '../Modelos/conexion.php';



if (isset($_GET['cerrar_sesion'])) {
session_unset();
session_destroy();
}
if (isset($_SESSION['rol'])) {
    switch ($_SESSION) {
        case 1:
            header('location: newind.php');
            break;
        case 2:
            header('location: newind.php');
            break;
        default:
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $conn=mysqli_connect("127.0.0.1","admone","123","tienda");
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  /*$query = "SELECT username, contraseña FROM usuarios where username = '$username' and contraseña = '$password';";
        $rs = $db->Execute($query);
        $arreglo1 = $rs->getRows();*/
        $sql = "SELECT id_rol FROM usuarios where username = '$username' and contraseña = '$password';";
        $result = mysqli_query($conn, $sql);
        $datas = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $datas[] = $row;
            }
        }
  if(count($datas) > 0) {
       //print_r($datas[0]);
       foreach ($datas[0] as $data) {
        $rol = $data[0];
       }
       $_SESSION['rol'] = $rol;
       $_SESSION['username'] = $username;
       $sql = "SELECT id_usuario FROM usuarios where username = '$username';";
       $result = mysqli_query($conn, $sql);
       $idarreglo = mysqli_fetch_all($result);

       $_SESSION['userid'] = $idarreglo[0];
       switch ($_SESSION['rol']) {
        case 1:
            header('location: ../newind.php');
            break;
        case 2:
            header('location: ../newind.php');
            break;
        default:
    }
  }else {

  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../Assets/Styles/then.css">
    <link rel="stylesheet" href="../Assets/Styles/logen.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Iniciar sesion</title>
</head>
<body>
    <!--  header -->
    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="./Indix.html"><h3 class="tituoloco">Camisetas el chido</h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="../Index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../aboutus.html">Contactus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../FAQ.html">About us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./login1.php">Iniciar sesion</a>
            </li>
          </ul>
        </div>
      </nav>
       <!--  header -->
       <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <!-- form -->
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-light">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-light">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-light">Password:</label><br>
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-light"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="./login.php" class="text-light">Register here</a>
                            </div>
                        </form>
                        <!-- form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>