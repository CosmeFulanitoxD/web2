<?php 
class basemod
{
    private $id_prod;
    private $stock;
    private $reorden;
    private $unidades_c;
    private $costo;
    private $url;
    private $db;


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
        $record['stock'] = $_POST['txtstock'];
        $record['nombre'] = $_POST['txtnombre'];
        $record['reorden'] = $_POST['txtreorden'];
        $record['unidades'] = $_POST['txtunidades_c'];
        $record['costo'] = $_POST['txtcosto'];
        $record['url'] = $_POST['txturl'];

        $this->db->autoExecute($table,$record,'UPDATE','id_producto = '.'\''.$_POST['hddid'].'\'');
    }

    function getAllProducts(){
        $query = "SELECT * FROM productos";
        $rs = $this->db->Execute($query);
        return $rs;
    }
}


?>