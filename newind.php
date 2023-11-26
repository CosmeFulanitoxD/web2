<?php 

require './Modelos/config.php';

$identify = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="icon" href="./Assets/Images/calavera.gif">
    <link rel="stylesheet" href="./Assets/Styles/Style.css">
    
    <title>Camisetas el chido</title>
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
              <a class="nav-link" href="./newind.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./aboutus.html">Contactus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./FAQ.html">About us</a>
            </li>
             <?php  if (($identify == 1)){
                
             ?>
            <li class="nav-item">
              <a class="nav-link" href="./Views/Productos.php">Productos</a>
            </li>
             <?php } ?>
             <?php  if (($identify == 1)){
                
                ?>
               <li class="nav-item">
                 <a class="nav-link" href="./Views/estadistica.php">Estadisticas</a>
               </li>
                <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="./Views/tienda.php">Tienda</a>
            </li>
            <?php if (is_null($identify)) {?>
            <li class="nav-item">
              <a class="nav-link" href="./Views/login.php">Registrate</a>
            </li>
            <?php } ?>
            <?php if (is_null($identify)) {?>
            <li class="nav-item">
              <a class="nav-link" href="./Views/login1.php">Iniciar sesion</a>
            </li>
            <?php } ?>
            <div class="username">Bienvenido <?php echo  $_SESSION['username']; ?></div>
          </ul>
        </div>
      </nav>
      <section class="otter">
        <div class="principal col-1">
          <img src="https://img.freepik.com/vector-premium/trabajador-profesional-supermercado-tienda-tienda-stocktacking-merchandising-contabilidad-caja_573942-1723.jpg?w=2000" alt="">
          <div class="solos">
            <h3>ATENDERLO ES LO MAS IMPORTANTE PARA NOSOTROS</h3>
            <p>¿Qué significa «el cliente primero» o customer first? Tal como lo sugiere su nombre, 
              una estrategia donde el cliente es lo primero busca satisfacer las necesidades del cliente al crear las mejores experiencias de marca.</p>
          </div>
        </div>
        
      </section>
      
<!--
        <section class="row">
            <div class="columne col-md-3 col-lg-3">
                <img src="https://http2.mlstatic.com/D_NQ_NP_951102-CBT71113994961_082023-O.webp" alt="">
                    <div class="nene">
                        <h3 class="hehe">Camisetas de roblox</h3>
                        <h3>a los chavos les facina el roblox asi que, porque no gastar tu dinero en el roblox?</h3>
                    </div>
                </img>
            </div>
            <div class="columne col-md-3 col-lg-3">
                <img src="https://m.media-amazon.com/images/I/41XRtlAYFzL._AC_SY580_.jpg" alt="">
                    <div class="nene">
                        <h3 class="hehe">Camisetas de los bandas</h3>
                        <h3>Para mostrar que te gusta el rock y que no te gustan las bandas por moda te vendemos camisetas de bandas para que seas muy interesante</h3>
                    </div>
                </img>
            </div>
            <div class="columne col-md-3 col-lg-3">
                <img src="https://m.media-amazon.com/images/I/51grgT1cG6L._AC_SY580_.jpg" alt="">
                    <div class="nene">
                        <h3 class="hehe">Camisetas de videojuegos</h3>
                        <h3>mario bros, fireboy, monster hunter, demuestra tu conocimiento videojueguil comprando unas camisetotas para ti campeonson</h3>
                    </div>
                </img>
            </div>
        </section>
      -->

      <section class="row">
        <div class="curso_columna col-md-6">
          <img src="https://http2.mlstatic.com/D_NQ_NP_951102-CBT71113994961_082023-O.webp" alt="">
          <div class="suelos">
            <h3>Camisetas de roblox</h3>
            <p>a los chavos les facina el roblox asi que, porque no gastar tu dinero en el roblox?</p>
          </div>
        </div>
        <div class="curso_columna col-md-6">
          <img src="https://m.media-amazon.com/images/I/41XRtlAYFzL._AC_SY580_.jpg" alt="">
          <div class="suelos">
            <h3>Camisetas de los bandas</h3>
            <p>Para mostrar que te gusta el rock y que no te gustan las bandas por moda te vendemos camisetas de bandas para que seas muy interesante</p>
          </div>
        </div>
        <div class="curso_columna col-md-6">
          <img src="https://m.media-amazon.com/images/I/51grgT1cG6L._AC_SY580_.jpg" alt="">
          <div class="suelos">
            <h3>Camisetas de videojuegos</h3>
            <p>mario bros, fireboy, monster hunter, demuestra tu conocimiento videojueguil comprando unas camisetotas para ti campeonson</p>
          </div>
        </div>
        <div class="curso_columna col-md-6">
          <img src="https://down-mx.img.susercontent.com/file/492d001da7a2bd8580c68d365d3417f0_tn" alt="">
          <div class="suelos">
            <h3>Camisas alucinas</h3>
            <p>Camisas con pollos, gallos, caballos, cocodrilos, vacas, leones y todos los animales de granja para sus gustos alucinicos para que diga con orgullo y con su musica al 200%: YO SOY ALUCIN!!</p>
          </div>
        </div>
      </section>
         <!-- end prueba -->
      </main>
      <footer id="dk-footer" class="dk-footer">
        <!-- Footer -->
	<section id="footer">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Links chidos checalos</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="./Indix.html"><i class="fa fa-angle-double-right"></i>Home</a></li>
						<li><a href="./aboutus.html"><i class="fa fa-angle-double-right"></i>About</a></li>
						<li><a href="./FAQ.html"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
					<ul class="list-unstyled list-inline social text-center">
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-facebook"></i></a></li>
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-google-plus"></i></a></li>
						<li class="list-inline-item"><a href="javascript:void();" target="_blank"><i class="fa fa-envelope"></i></a></li>
					</ul>
				</div>
				</hr>
			</div>	
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
					<p>Copyright maxpalma palmware</p>
				</div>
				</hr>
			</div>	
		</div>
	</section>
	<!-- ./Footer -->
      </footer>
</body>

</html>