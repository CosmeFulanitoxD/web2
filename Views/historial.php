<?php 
require '../Modelos/Database.php';
require '../Modelos/config.php';
$db = new Database();
$con = $db->conectar();
# $token_tmp = null;
$identify = $_SESSION['rol'];
$usuarioid = $_SESSION['userid'][0];
$producto = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] :null;
$nombre = null;
$cantidad = null;
$precio = null;
$url = null;
$lista_carrito = array();
# $producto = ($_POST['carro']['productos']);
#print_r($_POST);
#echo $producto;
#print_r($producto);
/*
if($producto != null){
  foreach ($producto as $clave => $cantidad) {
    
    $sql = $con->prepare("SELECT * FROM compra WHERE id_usuario=?");
    $sql->execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    
  }
}
print_r ($lista_carrito);*/
$conn=mysqli_connect("127.0.0.1","admone","123","tienda");
$sql = "SELECT * FROM compra WHERE id_usuario= $usuarioid";
$result = mysqli_query($conn,$sql);
$datas = array();
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $datas[] = $row;
  }
}
//print_r($datas);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>historial de compra</title>
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
              <a class="nav-link" href="../newind.html">Home <span class="sr-only">(current)</span></a>
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

          </ul>
        </div>
      </nav>
      <main>
          <div class="principal">
            <div>
                <p>
                    Historial de compras recientes:
                </p>
            </div>
            <div class="container">
	<div class="row">
		
        
        <div class="col-md-12">
        <h4>HISTORIAL DE COMPRAS</h4>
        <div class="table-responsive">

                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   
                   <th>Id Compra</th>
                    <th>longitud</th>
                     <th>latitud</th>
                     <th>fecha</th>
                      <th></th>                     
                   </thead>
    <tbody>
    <?php 
            foreach ($datas as $producto) { 
              $id = $producto['id_compra'];
              $longitud=$producto['longitud'];
              $latitud=$producto['latitud'];
              $fecha=$producto['fecha'];
              ?>
    <tr>
    <td><?=$id ?></td>
    <td><?=$longitud ?></td>
    <td><?=$latitud ?></td>
    <td><?=$fecha ?></td>
    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><a href="yavpdf.php?id=<?= $id ?>" class="btn btn-primary btn-xs" data-title="Edit"  data-toggle="modal" data-target="#edit" >Descargar pdf</a></p></td>
    </tr>
    <?php 
    }
      ?>
 
    
    </tbody>
        
</table>

<div class="clearfix"></div>

                
            </div>
            
        </div>
	</div>
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" placeholder="Mohsin">
        </div>
        <div class="form-group">
        
        <input class="form-control " type="text" placeholder="Irshad">
        </div>
        <div class="form-group">
        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
    
        
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
          </div>

        </main>
</body>
</html>