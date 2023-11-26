<?php 
require '../Modelos/Database.php';
require '../Modelos/config.php';
$db = new Database();
$con = $db->conectar();
# $token_tmp = null;
$identify = $_SESSION['rol'];
$usuarioid = $_SESSION['userid'][0];
$producto = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] :null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Estadisticas</title>
    <link rel="stylesheet" href="../Assets/Styles/FAQ.css">
    <link rel="stylesheet" href="../Assets/Styles/shopless.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="./Indix.html"><h3 class="tituoloco">Camisetas el chido</h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="../newind.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../aboutus.html">Contactus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../FAQ.html">About us</a>
            </li>

            <?php  if (($identify == 1)){
                
                ?>
               <li class="nav-item">
                 <a class="nav-link" href="./Views/Productos.php">Productos</a>
               </li>
                <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="./tienda.php">Tienda</a>

              <li class="nav-item">
              <a class="nav-link" href="./historial.php">Historial</a>

            <a href="checkout.php" class="btn btn-primary">
                Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
            </a>
            <div class="username">Bienvenido <?php echo  $_SESSION['username']; ?></div>

          </ul>
        </div>
      </nav>
      <main>
      <div class="card mt-5">
                    <div class="card-header">
                        <h4>Usted obtendra la grafica basada en las 2 fechas que ingresara a continuacion:</h4>
                    </div>
                    <div class="card-body">
                        
                        <form action="graph.php" method="POST">
                            
                            <div class="form-group mb-3">
                                <label for="">Fecha 1</label>
                                <input type="date" name="date1" class="form-control" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Fecha 2</label>
                                <input type="date" name="dates2" class="form-control" />
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="save_date" class="btn btn-primary">Generar</button>
                            </div>
                        </form>

                    </div>
                </div>
      </main>
</body>
</html>