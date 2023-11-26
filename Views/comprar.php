<?php 
require '../Modelos/Database.php';
require '../Modelos/config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
$mail = new PHPMailer(true);
$db = new Database();
$con = $db->conectar();
$producto = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] :null;
$lista_carrito = array();
if (isset($_POST['action'])){
     $action = $_POST['action'];
     if ($action == 'compratotal'){
        $conn=mysqli_connect("127.0.0.1","admone","123","tienda");
        $id = $_SESSION['userid'][0];
       // $sql = "INSERT into compra_detalle (id_compra, id_producto, cantidad) values (5,1,2)";
       $sql = "INSERT into compra (id_usuario,latitud,longitud) values ($id,'124233456','123454236')";
        //$sql = 'SELECT id_compra from compra order by id_compra desc limit 1';
        //$sql = "SELECT id_rol FROM usuarios where username = '$username' and contraseña = '$password';";
        $result = mysqli_query($conn, $sql);
        
       // $mostrar = mysqli_fetch_all($result);

        //$mostrar[1] = 'dasdas';  --- recordar
        $producto = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] :null;
        //$conta = 0;
        $sql = 'SELECT id_compra from compra order by id_compra desc limit 1';
        $result = mysqli_query($conn, $sql);
        $mostrar = mysqli_fetch_all($result);
        $compra = $mostrar[0];                              
        foreach ($producto as $key => $value) {
          //  $lista_carrito[$conta] = '++Compra:'.$compra[0].' Usuario: '.$id.'Producto: '.$key.' Cantidad: '.$value.' +++';
           // print_r($compra[0]);
           $conn=mysqli_connect("127.0.0.1","admone","123","tienda");
            $sql = "INSERT into compra_detalle (id_compra, id_producto, cantidad) values ($compra[0],$key,$value)";
            $result2 = mysqli_query($conn, $sql);
            //$conta ++;
            echo"suavemente";
        }

        try {
         //$mail->SMTPDebug= SMTP::DEBUG_SERVER;
         $mail->isSMTP();
         $mail->Host='smtp.gmail.com';
         $mail->SMTPAuth= true;
         $mail->Username='20030370@itcelaya.edu.mx';
         $mail->Password='qahjaitzxpyauape';
         $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
         $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );
         $mail->Port=587;

         $mail->setFrom('20030370@itcelaya.edu.mx','CamisetasElChidoOficial');
         $mail->addAddress('killercoc547@gmail.com','Compratest');
         $mail->addCC('samuelghidorah123@gmail.com','CCtest');
         //----- thingy
         if($producto != null){
            foreach ($producto as $clave => $cantidad) {
              
              $sql = $con->prepare("SELECT id_producto, costo, nombre, url, $cantidad AS cantidad FROM productos WHERE id_producto=?");
              $sql->execute([$clave]);
              $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
              
            }
          }
         //----- end of thingy
         $mail->isHTML(true);
         $mail->Subject='Detalles de su venta';
         $mail->Body='
         <html><body>
<div id="headermail" style="background-color: #FF2222; font-family: fantasy; color: #FFFFFF; text-align: center; font-size: 65px;">
       CAMISETAS EL CHIDO
    </div>
<div class="maindiv" style="font-family: monospace;">
        <p>
            Hola querido usuario de nuestro sitio web, en este correo electronico viene informacion en relacion a su ultima compra:
        </p>
        <table style="background-color: #FF2222; font-size:20px; padding-right: 20px;">
            <thead>
            <tr>
                    <th>nombre</th>
                    <th>costo</th>
                    <th>cantidad</th>
                    <th>Subtotal</th>
                    
                  </tr>
            </thead>
            <tbody>';
            
             $total = 0;
             foreach ($lista_carrito as $producto) {
               $id = $producto['id_producto'];
               $nombre = $producto['nombre'];
               $costo = $producto['costo'];
               $cantidad = $producto['cantidad'];
               
               $subtotal = $cantidad * $costo;
               $total += $subtotal;
            
         $mail->Body.='
         <tr>
           <td> '.$nombre.'</td>
           <td>$'.$costo.'</td>
           <td> 
             <input type="number" min="1" max="10" step="1" value="'.$cantidad.'"
             size="5" id="cantidad_'.$id.'>                
           </td>

            <td>
             <div id="subtotal_'.$id.'" name= "subtotal[]" >$'.$subtotal.'</div>
            </td>

           
         </tr>';
         }
         $mail->Body.='
         <tr>
           <td colspan="3"></td></td>
           <td colspan="2">
             <p class="h3" id="total" >$'.$total.'</p>
           </td>
         </tr>
       </tbody>
        </table>
        <p>
            Esperemos que nuestros servicios hayan sido de su entera satisfaccion, si usted no reconoce esta transaccion entonces llame inmediatamente al servicio tecnico.
        </p>
       </div>
    <footer>
        <div id="footfeti" style="background-color: #FF2222; font-family: fantasy;text-align: center; color: #FFFFFF; font-size: 14px;">-maxware sa de cv todos los assets pertenecen a sus respectivos dueños-</div>
    </footer>
</body></html>
         ';
         $mail->send();

         echo 'enviado';
        } catch (Exception $e) {
         echo 'mensaje'.$mail->ErrorInfo;
        }
        unset($_SESSION['carrito']['productos']);
        echo json_encode($lista_carrito);
        
     }
     
}
?>
