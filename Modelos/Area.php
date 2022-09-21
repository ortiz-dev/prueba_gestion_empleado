<?php

class Area{

    public function obtenerAreas()
    {
        try{

            $pdo = Conexion::conectar();
            $areas = $pdo->query("SELECT * FROM areas")->fetchAll(PDO::FETCH_ASSOC);
            return $areas;

        }catch(PDOException $e){
            echo '<span class="alert-danger">Error al obtener las areas.'.$e->getMessage().'</span>';
        }
    }
}