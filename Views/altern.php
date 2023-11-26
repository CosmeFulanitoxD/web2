<?php 
require '../Modelos/Database.php';
require '../Modelos/config.php';
$db = new Database();
$con = $db->conectar();
$token_tmp = null;

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if (($id == '' || $token = '')) {
    echo'Error al procesar';
    exit;
}else {
    
    $token_tmp = hash_hmac('sha1',$id,KEY_TOKEN);

    $token = isset($_GET['token']) ? $_GET['token'] : '';

    if ($token == $token_tmp) {
        
        $sql = $con->prepare("SELECT count(id_producto) FROM productos
        where id_producto =?");
        $sql->execute([$id]);
        if( $sql->fetchColumn() > 0) {
            $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
            $sql = $con->prepare("SELECT nombre, costo, url FROM productos
            where id_producto =? limit 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row["nombre"];
            $costo = $row["costo"];
            $url = $row["url"];
            }
        

    } else {
        echo'Error al procesar la peticion';
        
    }

   // print_r($_SESSION);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <title>Tienda</title>
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
              <a class="nav-link" href="../Index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../aboutus.html">Contactus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../FAQ.html">About us</a>
            </li>

            <a href="checkout.php" class="btn btn-primary">
                Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
            </a>
            
          </ul>
        </div>
      </nav>

      <main>
        <div class="container">
         <div class="row">
            <div class="col-md-6 order-md-1">
                 <img src= <?php echo $url; ?> alt="">
            </div>
            <div class="col-md-6 order-md-2">
                  <h2>
                    <?php echo $nombre;  ?>
                  </h2>
                <p class="lead">
                    Esta a punto de poner en el carrito a <?php echo $nombre; ?>
                </p>

                <div class="d-grip gap-3 col-10 mx-auto">
                    <button class="btn btn-primary" onclick="addProducto(<?php echo $id; ?>,'<?php echo $token_tmp ?>')" type="button">
                     Agregar al carro
                    </button>
                </div>
            </div>
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
            }).then(response => response.json())
            .then(data => {
                if(data.ok){
                    let elemento =document.getElementById("num_cart")
                    elemento.innerHTML = data.numero
                }
            })
        }

        
        
        
        function Insertar(nombre,cantidad,precio,url){
            var formData = $('#frmproducto').serialize();
            $.ajax({
                type:"POST",
                url:"../Controladores/ctrlProd.php?opc=5",
                data:formData,
                success:function(data){
                    $('#productos').html(data);
                },
            })
        }

        

      </script>
</body>
</html>