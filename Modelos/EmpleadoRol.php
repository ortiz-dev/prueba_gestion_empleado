<?php

class EmpleadoRol
{
    public function obtenerRolesEmpleado($id)
    {
        try{

            $pdo = Conexion::conectar();
            $roles_empleado = $pdo->prepare("SELECT * FROM empleado_rol WHERE empleado_id=:id");
            $roles_empleado->execute($id);
            
            return $roles_empleado->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function registrar($roles, $id_empleado)
    {
        try{

            $pdo = Conexion::conectar();
            foreach($roles as $rol){
                $datos = [$id_empleado, $rol];
                $roles_empleado = $pdo->prepare("INSERT INTO empleado_rol(empleado_id, rol_id) VALUES(?, ?)");
                $roles_empleado->execute($datos);
            }

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function actualizar($roles, $id_empleado)
    {
        try{ 
            $pdo = Conexion::conectar();
            $this->eliminar($id_empleado);
            foreach($roles as $rol){
                $datos = [$id_empleado, $rol];
                $roles_empleado = $pdo->prepare("INSERT INTO empleado_rol(empleado_id, rol_id) VALUES(?, ?)");
                $roles_empleado->execute($datos);
            }

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function eliminar($id_empleado)
    {
        try{

            $pdo = Conexion::conectar();
            
            $datos = [$id_empleado, $id_empleado];
            $roles_empleado = $pdo->prepare("DELETE FROM empleado_rol WHERE empleado_id=? and rol_id in(select rol_id from empleado_rol where empleado_id=?)");
            $roles_empleado->execute($datos);
        

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

}