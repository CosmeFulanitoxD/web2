<?php 
require '../Modelos/Database.php';
require '../Modelos/config.php';

$identify = $_SESSION['rol'];
$db = new Database();
$con = $db->conectar();
$fecha1 = $_POST['date1'];
$fecha2 = $_POST['dates2'];
$conn=mysqli_connect("127.0.0.1","admone","123","tienda");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Graphs</title>
    <link rel="stylesheet" href="../Assets/Styles/FAQ.css">
    <link rel="stylesheet" href="../Assets/Styles/shopless.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php 
          $sql = "SELECT p.Nombre, COUNT(cd.cantidad) as cantidad
          FROM compra c JOIN compra_detalle cd ON c.id_compra = cd.id_compra JOIN productos p on cd.id_producto = p.id_producto 
          WHERE fecha BETWEEN '$fecha1' and '$fecha2' GROUP BY p.Nombre;";
          $result = mysqli_query($conn,$sql);
          $datas = array();
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "['".$row['Nombre']."', ".$row['cantidad']."],";
            }
          }
          ?>
        ]);

        var options = {
          title: 'Los mas vendidos del <?= $fecha1?> al <?= $fecha2?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
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
<div id="piechart" style="width: 1000px; height: 1000px; margin:0 auto;"></div>
</body>
</html>