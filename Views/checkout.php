<?php 
require '../Modelos/Database.php';
require '../Modelos/config.php';
require '../Modelos/conexion.php';
$db = new Database();
$con = $db->conectar();
$producto = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] :null;
//print_r($_SESSION['carrito']['productos']);
$lista_carrito = array();
# $producto = ($_POST['carro']['productos']);
#print_r($_POST);
#echo $producto;
#print_r($producto);

if($producto != null){
  foreach ($producto as $clave => $cantidad) {
    
    $sql = $con->prepare("SELECT id_producto, costo, nombre, url, $cantidad AS cantidad FROM productos WHERE id_producto=?");
    $sql->execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    
  }
}
//print_r($lista_carrito);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/Styles/FAQ.css">
    <link rel="stylesheet" href="../Assets/Styles/Style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
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
              <a class="nav-link" href="../Index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../aboutus.html">Contactus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../FAQ.html">About us</a>
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
                    <th>Subtotal</th>
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
                        $cantidad = $producto['cantidad'];
                        
                        $subtotal = $cantidad * $costo;
                        $total += $subtotal;
                     
                  ?>
                  <tr>
                    <td><?php echo $nombre ?></td>
                    <td>$<?php echo $costo ?></td>
                    <td> 
                      <input type="number" min="1" max="10" step="1" value="<?php echo ($cantidad); ?>"
                      size="5" id="cantidad_<?php echo $id; ?>" onchange="actualizacantidad(this.value, <?php echo $id; ?>)">                
                    </td>

                     <td>
                      <div id="subtotal_<?php echo $id; ?>" name= "subtotal[]" >$<?php echo $subtotal; ?></div>
                     </td>

                    <td> <a id="eliminar" class="btn btn-danger btn-sm" onclick="eliminar(<?php echo $id; ?>)" data-id="<?php echo $id; ?>">Eliminar</a></td>
                  </tr>
                  <?php }  ?>
                  <tr>
                    <td colspan="3"></td></td>
                    <td colspan="2">
                      <p class="h3" id="total" >$<?php echo $total; ?></p>
                    </td>
                  </tr>
                </tbody>
                <?php } ?>
              </table>
         </div>
         <div class="row">
          <div col-md-5 offset-md-7 d-grid gap-2>
            <button class="btn btn-primary btn-lg" onclick="comprarreal(<?php echo $id; ?>)">Realizar pago</button>
          </div>
         </div>
        </div>


      </main>

      <!-- Modal -->
      <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminaModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

      <script>
        
        function eliminar(id) 
{  
    let url = 'actualizar_carro.php'
    let formData = new FormData()
    formData.append('action', 'eliminar')
    formData.append('id', id)

    fetch (url, 
        {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => {
                if (data.ok) 
                {
                    location.reload()
                }
            })
}

        function comprarreal(id) {
          let url = 'comprar.php'          
          let formData = new FormData()
          formData.append('id',id)
          formData.append('action','compratotal')

          fetch(url, {
            method: 'POST',
            body:formData,
            mode: 'cors'
          }).then(response => response.json())
          .then(data=> {
            if (data.ok) {
              location.reload()
            }
          })
        }


        function actualizacantidad(cantidad,id) {
            let url = './actualizar_carro.php'
            let formData =new FormData()
            formData.append('action','agregar')
            formData.append('id', id)
            formData.append('cantidad', cantidad)

            fetch(url, {
                method: 'POST',
                body:formData,
                mode:'cors'
            }).then(Response => Response.json())
            .then(data => {
                if(data.ok){
                    let divsubtotal = document.getElementById('subtotal_' + id)
                    divsubtotal.innerHTML =data.sub
                    

                    let total = 0.00
                    let list =document.getElementsByName('subtotal[]')

                    for(let i = 0; i< list.length; i++){
                      total +=parseFloat(list[i].innerHTML.replace(/[$]/g, ''))
                    }

                    total =new Intl.NumberFormat('en-US',{
                      minimumFractionDigits: 2
                    }).format(total)

                    document.getElementById('total').innerHTML = total
                }
            })
        }
        
        function comprar(id) {
          let url = 'actualizar_carro.php'
    let formData = new FormData()
    formData.append('action', 'comprar')
    formData.append('id', id)

    fetch (url, 
        {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => {
                if (data.ok) 
                {
                    location.reload()
                }
            })
        }

        

      </script>
</body>
</html>