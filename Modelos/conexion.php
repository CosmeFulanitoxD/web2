<?php
class Conexion{
    private $DBType = 'mysqli';
    private $DBServer = '127.0.0.1'; // server name or IP address
    private $DBUser = 'admone';
    private $DBPass = '123';
    private $DBName = 'tienda';

    public function __construct(){}
    
    public function conectar(){
        $con = adoNewConnection($this->DBType);
        $con->debug = false;
        $con->connect($this->DBServer,$this->DBUser,$this->DBPass,$this->DBName);
        return $con;
    }
}
?>