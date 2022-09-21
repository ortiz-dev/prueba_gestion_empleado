<?php

class Rol
{
    public function obtenerRoles()
    {
        try{

            $pdo = Conexion::conectar();
            $roles = $pdo->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);
            return $roles;

        }catch(PDOException $e){
            echo '<span class="alert-danger">Error al obtener los roles. '.$e->getMessage().'</span>';
            return [];
        }
    }

}