<?php 
require '../Modelos/config.php';
//print_r($_SESSION);

if (!isset($_SESSION['rol'])) {
    header('location: login1.php');
}else {
    if (($_SESSION['rol'] != 1)) {
          header('location: login1.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/Styles/FAQ.css">
    <link rel="stylesheet" href="../Assets/Styles/Style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function editar(id_Producto,stock,Nombre,reorden,unidades,costo,url){
            document.getElementById('hddId').value = id_Producto;           
            document.getElementById('txtstock').value =stock;
            document.getElementById('txtnombre').value =Nombre;
            document.getElementById('txtreorden').value =reorden;
            document.getElementById('txtunidades_c').value =unidades;
            document.getElementById('txtcosto').value =costo;
            document.getElementById('txturl').value =url;
            console.log(id_Producto);
        }

        function editar2() {
            var formData = $('#frmproducto').serialize();
            $.ajax({
                type:"POST",
                url:"../Controladores/ctrlProd.php?opc=2",
                data:formData,
                success:function(data){
                    $('#productos').html(data);
                },
            })
        }

        function Insertar(){
            var formData = $('#frmproducto').serialize();
            $.ajax({
                type:"POST",
                url:"../Controladores/ctrlProd.php?opc=1",
                data:formData,
                success:function(data){
                    $('#productos').html(data);
                },
            })
        }
        function eliminar(id) {
      $.ajax({
        type: "POST",        
        url: "../Controladores/ctrlProd.php?opc=3",
        data: {id_Producto:id},
        success: function (data) {
          $('#resAJAX').html(data);
        },
      })
    }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="../Index.html"><h3 class="tituoloco">Camisetas el chido</h3></a>
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
          </ul>
        </div>
      </nav>

      <main>
        <div class="prodcontainer">
            <h3>Productos</h3>
            <div id="resAJAX"></div>
           
            <form id="frmproducto" action="">
            <input type="hidden" id="hddId" name="hddId">

                    <div class="form-group">                      
                    <label for="txtstock">stock</label>
                    <input type="text" name="txtstock" id="txtstock">
                </div>

                <div class="form-group">                      
                    <label for="txtnombre">nombre</label>
                    <input type="text" name="txtnombre" id="txtnombre">
                </div>

                    <div class="form-group">                    
                    <label for="txtreorden">reorden</label>
                    <input type="text" name="txtreorden" id="txtreorden">
                </div>

                    <div class="form-group">   
                    <label for="txtunidades_c">unidades</label>
                    <input type="text" name="txtunidades_c" id="txtunidades_c">
                </div>

                    <div class="form-group">                       
                    <label for="txtcosto">costo</label>
                    <input type="text" name="txtcosto" id="txtcosto">
                </div>

                <div class="form-group">                       
                    <label for="txturl">url</label>
                    <input type="text" name="txturl" id="txturl">
                </div>
                </input>
                <button type="button" onclick="Insertar()" class="btn btn-info">Insertar</button>
                <button type="button" onclick="editar2()" class="btn btn-warning">Update</button>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">nombre</th>
                        <th scope="col">stock</th>
                        <th scope="col">reorden</th>
                        <th scope="col">unidades</th>
                        <th scope="col">costo</th>
                        <th scope="col">url</th>
                    </tr>
                </thead>
                <tbody id="productos">

                </tbody>
            </table>
        </div>
      </main>
</body>
</html>
<script>
    $(document).ready(function () {
        $.ajax({
            type: "POST",
            data:{},
            url:"../Controladores/ctrlProd.php?opc=4",
            success:function (data) {
                $('#productos').html(data);
            }
        })
    })
</script>
