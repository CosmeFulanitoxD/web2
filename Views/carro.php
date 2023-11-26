<?php 
require '../Modelos/config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $token = $_POST['token'];

    $token_tmp = hash_hmac('sha1',$id,KEY_TOKEN);

    if ($token == $token_tmp) {

        if(isset($_SESSION['carrito']['productos'][$id])){
            $_SESSION['carrito']['productos'][$id] += 1;
            $idas = $id;
            $conn=mysqli_connect("127.0.0.1","admone","123","tienda");

            $sql="CALL menos($idas,1);";
            $result=mysqli_query($conn,$sql);
            echo $result;
        }
        
        else {
            $_SESSION['carrito']['productos'][$id] = 1;
        }
        $datos['wea'] = ($_SESSION['carrito']['productos'][$id]);
        $datos['numero'] = count($_SESSION['carrito']['productos']);
        $datos['ok'] = true;
    } else {
        $datos['ak'] = false;
    }

} else {
    $datos['ek'] = false;
}

echo json_encode($datos);
?>
