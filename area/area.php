<?php

include_once('../database/conexion.php');

class Area
{
    
    public function listar(){
        try{

            $pdo = Conexion::conectar();
            $areas = $pdo->query("SELECT * FROM areas")->fetchAll(PDO::FETCH_ASSOC);
            return $areas;

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function registrar($request){
        try{
            $datos = [];
            $pdo = Conexion::conectar();
            $consulta_area = $pdo->prepare("INSERT INTO areas(nombre) VALUES(:nombre)");
            $consulta_area->execute($datos);
            $pdo = null;
            $consulta_area = null;

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function actualizar($request){
        $datos = [];
        $pdo = Conexion::conectar();
        $consulta_area = $pdo->prepare("UPDATE areas SET nombre=:nombre WHERE id=:id)");
        $consulta_area->execute($datos);
        $pdo = null;
        $consulta_area = null;
    }

    public function eliminar($id){
        $datos = [];
        $pdo = Conexion::conectar();
        $consulta_area = $pdo->prepare("DELETE FROM areas WHERE id=:id)");
        $consulta_area->execute($datos);
        $pdo = null;
        $consulta_area = null;
    }

}

