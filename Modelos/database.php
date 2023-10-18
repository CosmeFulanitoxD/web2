<?php 
class Database
{
    private $DBType = 'mysqli';
    private $DBServer = '127.0.0.1'; // server name or IP address
    private $DBUser = 'admone';
    private $DBPass = '123';
    private $DBName = 'tienda';

    function conectar() {
        try {
            $conexion = "mysql:host=".$this->DBServer."; dbname=".$this->DBName;
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
           $pdo = new PDO($conexion,$this->DBUser,$this->DBPass,$options);
           
           return $pdo;

        } catch (PDOException $e) {
            echo 'Errore: '. $e->getMessage();
            
            exit;# code...
        }
    }
    
}

?>