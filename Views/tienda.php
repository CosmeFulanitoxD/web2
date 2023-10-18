<?php 
require '../Modelos/Database.php';
require '../Modelos/config.php';
$db = new Database();
$con = $db->conectar();
$token_tmp = null;


$nombre = null;
$cantidad = null;
$precio = null;
$url = null;

$sql = $con->prepare("SELECT id_producto, costo, nombre, url FROM productos");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="./Assets/Styles/Style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
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
         <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php 
            foreach ($resultado as $row ) { ?>
                <div class="col">
                 <div class="card shadow-sm">
                  <img src= <?php echo $row['url'] ?> >
      
                  <div class="card-body">
                  <h5 class="card-title"><?php echo $row['nombre'] ?></h5>
                    <p class="card-text"><?php echo $row['costo'] ?></p>
                    <div class="d-flex justify-content-between align-items-center">
            
                      <a 
                      href="" class="btn btn-sm btn-outline-secondary" onclick="Insertar(<?php  echo $row['nombre'] ?>,1,<?php echo $row['costo'] ?>,<?php echo $row['url'] ?>)" value="Add to cart" name="Add_to_cart">Añadir</a>
                    
                      
                    
                    </div>
                    <div>
                  </div>
                  </div> 
            <?php }  ?>
            
         
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