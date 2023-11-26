<?php 
use SebastianBergmann\Environment\Console;

require '../Modelos/config.php';
class basemod
{
    private $id_prod;
    private $stock;
    private $reorden;
    private $unidades_c;
    private $costo;
    private $url;
    private $db;

    private $usuario;
    private $correo;
    private $contraseña;


    public function __construct() {
        $con = new Conexion();
        $this->db = $con ->conectar();
    }

    function insertados($stock) {
        $table = 'productos';
        $record = array();
        $record['stock'] = $stock;
        $record['nombre'] = $_POST['txtnombre'];
        $record['reorden'] = $_POST['txtreorden'];
        $record['unidades_c'] = $_POST['txtunidades_c'];
        $record['costo'] = $_POST['txtcosto'];
        $record['url'] = $_POST['txturl'];
        $this->db->autoExecute($table,$record,'INSERT');
    }

    function comprados(){
        
    }

    function registro(){
        $table = 'usuarios';
        $record = array();
        $record['correo'] = $_POST['txtemail'];
        $checkmail = $_POST['txtemail'];
        $record['username'] = $_POST['txtusuario'];
        $record['contraseña'] = md5($_POST['txtpass']);
        $record['id_rol'] = '2';
        $query = "SELECT correo FROM usuarios where correo = '$checkmail';";
        $rs = $this->db->Execute($query);
        $ra = $rs->getRows();
        if(empty($record['correo']) || empty($record['username']) || empty( $record['contraseña'])) {
            echo '<script language="javascript">alert("Formulario vacio, ingrese datos en los campos requeridos");</script>';
        }
        elseif(!filter_var($record['correo'], FILTER_VALIDATE_EMAIL)) {
            echo '<script language="javascript">alert("Correo no valido");</script>';
        }
        elseif (!empty($ra)) {
            echo '<script language="javascript">alert("correo ya registrado");</script>';
        }
        
        else {
            $this->db->autoExecute($table,$record,'INSERT');# code...
            echo '<script language="javascript">alert("Usuario inscrito correctamente");</script>';
        }

        
    }



    function insertados2() {
        $table = 'carro';
        $record = array();
        $record['nombre'] = $_POST['nombre'];
        $record['precio'] = $_POST['precio'];
        $record['url'] = $_POST['url'];
        $record['cantidad'] = $_POST['cantidad'];
        $this->db->autoExecute($table,$record,'INSERT');
    }

    function updates(){
        $table = 'productos';
        $record = array();
       # $record['id_producto'] = $_POST['hddId'];
        $record['stock'] = $_POST['txtstock'];
        $record['nombre'] = $_POST['txtnombre'];
        $record['reorden'] = $_POST['txtreorden'];
        $record['unidades'] = $_POST['txtunidades_c'];
        $record['costo'] = $_POST['txtcosto'];
        $record['url'] = $_POST['txturl'];
        #print_r($_POST);
        $this->db->autoExecute($table,$record,'UPDATE','id_producto = '.'\''.$_POST['hddId'].'\'');
    }

    function delete1($id) {
        $query = "DELETE FROM productos WHERE id_producto = ".$id;
        $res = $this->db->Execute($query);
        session_destroy();
    }

    function getAllProducts(){
        $query = "SELECT * FROM productos";
        $rs = $this->db->Execute($query);
        return $rs;
    }
}


?>