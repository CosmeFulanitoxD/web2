<?php 


require '../Modelos/Database.php';
require '../Modelos/config.php';
$db = new Database();
$con = $db->conectar();
# dsdsa
$producto = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] :null;
$lista_carrito = array();
if($producto != null){
    foreach ($producto as $clave => $cantidad) {
      
      $sql = $con->prepare("SELECT id_producto, costo, nombre, url, $cantidad AS cantidad FROM productos WHERE id_producto=?");
      $sql->execute([$clave]);
      $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
      
    }
  }
#aqui acaba la wea
if($producto != null){
    foreach ($producto as $clave => $cantidad) {
      
      $sql = $con->prepare("SELECT id_producto, costo, nombre, url, $cantidad AS cantidad FROM productos WHERE id_producto=?");
      $sql->execute([$clave]);
      $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
      
    }
  }

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] :0;

    if($action == 'agregar'){ 
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] :0;
        $respuesta = agregar($id,$cantidad);
        if($respuesta>0){ 
           $datos['ok'] = true;
        } else {
            $datos['oke'] = false;
        }
          $datos['sub'] = $respuesta;
    } elseif ($action = 'eliminar') {
        $datos['ok'] = eliminar($id);
    } elseif ($action = 'Comprar') {
       #$productos = isset($_POST['carrito']['productos']) ? $_POST['carrito']['productos'] :null;
       $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] :0;
       $datos['ok'] = comprar($lista_carrito,$cantidad);
    }
} else {
    $datos['oka'] = false;
}

echo json_encode($datos);

function agregar($id,$cantidad){
    $res = 0;
    if ($id > 0 && $cantidad > 0 && is_numeric($cantidad)) {
        if (isset($_SESSION['carrito']['productos'][$id])) {
            $_SESSION['carrito']['productos'][$id] = $cantidad;

            $db = new Database();
            $con = $db->conectar();
            $sql = $con->prepare("SELECT nombre, costo, url FROM productos
            where id_producto =? limit 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row["nombre"];
            $costo = $row["costo"];
            $url = $row["url"];

            $res = $cantidad * $costo;
            return $res;
        }
    }else {
        return $res;
    }
}

function comprar( $lista, $cantidad ) {
    foreach ($lista as $producto) {
        $id = $producto['id_producto'];
                        $db = new Database();
                        $con = $db->conectar();
                        $sql = $con->prepare("UPDATE productos set stock = stock - ? where id_producto = ?");
                        $sql->bindParam('',$cantidad, $id);
        
    }
    session_destroy();
     return true;
}

function eliminar($id){
    if ($id > 0) {
        if (isset($_SESSION["carrito"]["productos"][$id])) {
            unset($_SESSION["carrito"]["productos"][$id]);
            return true;
        }
    }else {
        return false;
    }
}
?>