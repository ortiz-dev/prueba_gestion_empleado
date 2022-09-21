<?php
include_once('database/conexion.php');
require_once('Area.php');
require_once('Rol.php');
require_once('EmpleadoRol.php');

class Empleado
{
    public function listar()
    {
        try{

            $pdo = Conexion::conectar();
            $empleados = $pdo->query("SELECT * FROM empleado")->fetchAll(PDO::FETCH_ASSOC);
            return $empleados;

        }catch(PDOException $e){
            echo '<span class="alert-danger">Error al obtener lista de empleados. '.$e->getMessage().'</span>';
            return [];
        }
    }

    public function registrar($empleado, $roles)
    {
        try{
            
            $pdo = Conexion::conectar();
            $consulta_empleado = $pdo->prepare("INSERT INTO empleado(nombre,email,sexo,area_id,boletin,descripcion) VALUES(:nombre,:email,:sexo,:area_id,:boletin,:descripcion)");
            $consulta_empleado->execute($empleado);
            $id_empleado = $pdo->lastInsertId();
            $empleado_rol = new EmpleadoRol();
            $empleado_rol->registrar($roles, $id_empleado);
            $pdo = null;
            $consulta_empleado = null;

        }catch(PDOException $e){
            echo '<span class="alert-danger">Error al registrar los datos de empleado. '.$e->getMessage().'</span>';
        }
    }

    public function actualizar($empleado, $roles)
    {
        try{
            
            $pdo = Conexion::conectar();
            $consulta_empleado = $pdo->prepare("UPDATE empleado SET nombre=:nombre, email=:email, sexo=:sexo, area_id=:area_id, boletin=:boletin, descripcion=:descripcion WHERE id=:id");
            $consulta_empleado->execute($empleado);
            $id_empleado = $empleado['id'];
            $empleado_rol = new EmpleadoRol();
            $empleado_rol->actualizar($roles, $id_empleado);
            $pdo = null;
            $consulta_empleado = null;
        }catch(PDOException $e){
            echo '<span class="alert-danger">Error al actualizar datos de empleado. '.$e->getMessage()-'</span>';
        }
    }

    public function eliminar($id)
    {
        try{
            $pdo = Conexion::conectar();
            $empleado_rol = new EmpleadoRol();
            $empleado_rol->eliminar($id_empleado);
            $consulta_empleado = $pdo->prepare("DELETE FROM empleado WHERE id=:id");
            $consulta_empleado->execute($id);
            $pdo = null;
            $consulta_empleado = null;
        }catch(PDOException $e){
            echo '<span class="alert-danger">Error al eliminar empleado. '.$e->getMessage().'</span>';
        }
    }

    public function editar($id)
    {
        try{
              
            $pdo = Conexion::conectar();
            $respuesta = null;
            if($id['id']==0){
                $area = new Area();
                $rol = new Rol();
                $respuesta = [
                    'areas' => $area->obtenerAreas(), 
                    'roles' => $rol->obtenerRoles()
                ];
            }else{
                
                $empleado = $pdo->prepare("SELECT * FROM empleado WHERE id=:id");
                $empleado->execute($id);
                $area = new Area();
                $rol = new Rol();
                $empleado_rol = new EmpleadoRol();
                $respuesta = [
                            'empleado' => $empleado->fetch(), 
                            'areas' => $area->obtenerAreas(), 
                            'roles' => $rol->obtenerRoles(),
                            'empleado_rol' => $empleado_rol->obtenerRolesEmpleado($id)
                        ];
            }
            return $respuesta;

        }catch(PDOException $e){
            echo '<span class="alert-danger">Error al editar empleado. '.$e->getMessage().'</span>';
            return [];
        }
    }

}