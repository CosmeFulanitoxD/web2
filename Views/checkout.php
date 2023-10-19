<?php 
require '../Modelos/Database.php';
require '../Modelos/config.php';
$db = new Database();
$con = $db->conectar();

$producto = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] :null;
print_r($_SESSION);
$lista_carrito = array();
# $producto = ($_POST['carro']['productos']);
#print_r($_POST);
#echo $producto;
#print_r($producto);

if($producto != null){
  foreach ($producto as $clave => $cantidad) {
    echo "dsadasdasdasd          ";
   
    $sql = $con->prepare("SELECT id_producto, costo, nombre, url, $cantidad AS cantidad FROM productos WHERE id_producto=?");
    $sql->execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    
  }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="./Assets/Styles/Style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>checkout</title>
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
              <a class="nav-link" href="./Index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./aboutus.html">Contactus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./FAQ.html">About us</a>
            </li>

            <a href="carro.php" class="btn btn-primary">
                Carrito<span id="num_cart" class="badge bg-secondary"></span>
            </a>
            
          </ul>
        </div>
      </nav>

      <main>
        <div class="container">
         <div class="table-response">
              <table class="table">
                <thead>
                  <tr>
                    <th>nombre</th>
                    <th>costo</th>
                    <th>cantidad</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                     if($lista_carrito == null){
                      echo '<tr><td colspan="4" class="text-center"><b>Lista vacia</b></td></tr>';
                     }else {
                      $total = 0;
                      foreach ($lista_carrito as $producto) {
                        $id = $producto['id_producto'];
                        $nombre = $producto['nombre'];
                        $costo = $producto['costo'];
                        $cantidad = $producto['cantidad']
                     
                  ?>
                  <tr>
                    <td><?php echo $nombre ?></td>
                    <td><?php echo $costo ?></td>
                    <td> <?php echo $cantidad ?> </td>
                    <td> <a href="#" id="eliminar" class="btn btn-danger btn-sm" data-bs-id="<?php echo $id ?>"
                     data-bs-toogle="modal" data-bs-target="eliminaModal">Eliminar</a></td>
                  </tr>
                  <?php }  ?>
                </tbody>
                <?php } ?>
              </table>
         </div>
        </div>
      </main>

      <script>
        function addProducto(id,token) {
            let url = './carro.php'
            let formData =new FormData()
            formData.append('id', id)
            formData.append('token', token)

            fetch(url, {
                method: 'POST',
                body:formData,
                mode:'cors'
            }).then(Response => Response.json())
            .then(data => {
                if(data.ok){
                    let elemento =document.getElementById("num_cart")
                    elemento.innerHTML = data.numero
                }
            })
        }

      </script>
</body>
</html>