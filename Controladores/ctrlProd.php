<?php 
require_once '../Assets/adodb5/adodb.inc.php';
require_once '../Modelos/conexion.php';
require_once '../Modelos/basemod.php';


if (isset($_GET["opc"])) {
    $prodmod = new basemod();

    switch ($_GET['opc']) {
        case 1:
            
            if (!empty($_POST['hddId'])) 
                $prodmod->updates();
            else {
                $stock = $_POST['txtstock'];
                $prodmod->insertados($stock);  
                echo getproductos($prodmod);
            }
           

            break;

        case 2:
            $prodmod->updates();
            echo getproductos($prodmod);
            break;

            case 3:
                $id_Producto = $_POST['id_Producto'];
                $prodmod->delete1($id_Producto);
                echo '<h5 class="miclasecss"><strong>Respuesta a la peticion AJAX</strong></h5>';
                echo $id_Producto;
                break;

            break;

        case 4:
            echo getproductos($prodmod);

        case 5:
            
            $prodmod ->insertados2();
             
            break;
            
        case 6:

            $prodmod->registro();
            //echo '<h5 class="miclasecss"><strong>Usuario registrado correctamente</strong></h5>';
            break;
        
    }
}
else {
    header('Location: ../index.html');
}

function getproductos($prodmod) {
    $response = '';
    $productos = $prodmod->getAllProducts();
    while (!$productos->EOF) {
        $response .= '<tr>
        <th scope="row">1</th>
        <td>'.$productos->fields[1].'</td>
        <td>'.$productos->fields[2].'</td>
        <td>'.$productos->fields[3].'</td>
        <td>'.$productos->fields[4].'</td>
        <td>'.$productos->fields[5].'</td>
        <td>'.$productos->fields[6].'</td>
        <td><a href="#" class="btn btn-success" onclick="editar('.$productos->fields[0].',\''.$productos->fields[2].'\',\''.$productos->fields[1].'\',\''.$productos->fields[3].'\'
        ,\''.$productos->fields[4].'\',\''.$productos->fields[5].'\',\''.$productos->fields[6].'\')">Editar</a></td>
        <td><input type="button" class="btn btn-danger" value="Eliminar" onclick="eliminar('.$productos->fields[0].')"></td>
    </tr>';
    $productos->moveNext();
    }
    return $response;
}
?>