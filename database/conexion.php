<?php

require_once('databases.php');

class Conexion
{

    public static function conectar()
    {   
        
        $pdo = new PDO('mysql:host='.HOST_DB.';dbname='.NAME_DB,USER_DB,PASSWORD_DB);
        return $pdo;
        
    }

}