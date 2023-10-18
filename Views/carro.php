<?php 
require '../Modelos/config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $token = $_POST['token'];

    $token_tmp = hash_hmac('sha1',$id,KEY_TOKEN);

    if ($token == $token_tmp) {
        if(isset($_SESSION['carrito']['productos'][$id])){
            $_SESSION['carrito']['productos'][$id] += 1;
        }
        
        else {
            $_SESSION['carrito']['productos'][$id] = 1;
        }
        $datos['numero'] = count($_SESSION['carrito']['productos']);
        $datos['ok']= true;
    } else {
        $datos['ak'] = false;
    }

} else {
    $datos['ek'] = false;
}

echo json_encode($datos);
echo json_encode($_POST['id'])
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href=".//Assets/Styles/Style.css">
    <title>Carrito</title>
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
            <li class="nav-item">
               <a href="" class="cart"><i class="fa-solid
               fa-cart-shopping"></i><span><sup>4</sup></span></a>
            </li>
          </ul>
        </div>
      </nav>
</body>
</html>