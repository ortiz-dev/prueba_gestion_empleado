<?php
require_once 'Modelos/Empleado.php';
 
class EmpleadoControlador{
    
    private $model;
    
    public function __construct()
    {
        $this->model = new Empleado();
    }
    
    public function index()
    {
    
        $empleados = $this->model->listar();
        require_once 'Vistas/header.php';
        require_once 'Vistas/listar.php';
        require_once 'Vistas/footer.php';
       
    }
    
    public function editar()
    {
                
        if(isset($_REQUEST['id'])){
            $id = ['id' => $_REQUEST['id']];
            $respuesta = $this->model->editar($id);
        }
        
        require_once 'Vistas/header.php';
        require_once 'Vistas/registrar.php';
        require_once 'Vistas/footer.php';
        
    }
    
    public function guardar()
    {
        if(isset($_REQUEST['id']) && isset($_REQUEST['nombre']) && isset($_REQUEST['email']) && isset($_REQUEST['sexo']) && isset($_REQUEST['area_id']) && isset($_REQUEST['descripcion']) && isset($_REQUEST['roles'])){
            
            $empleado['nombre'] = $_REQUEST['nombre'];
            $empleado['email'] = $_REQUEST['email'];
            $empleado['sexo'] = $_REQUEST['sexo'];
            $empleado['area_id'] = $_REQUEST['area_id'];
            $empleado['boletin'] = isset($_REQUEST['boletin']) ? 1 : 0;
            $empleado['descripcion'] = $_REQUEST['descripcion'];
            $_REQUEST['id']!=0 ? $empleado['id'] = $_REQUEST['id'] : '';

            $roles = $_REQUEST['roles'];
            $_REQUEST['id'] == 0 
            ? $this->model->registrar($empleado, $roles)
            : $this->model->actualizar($empleado, $roles);
            $mensaje = 'mensaje=Se guardaron los datos&color=alert-success';
        }else{
            $mensaje = 'mensaje=Los datos no se guardaron&color=alert-danger';
        }
        
        header('Location: index.php?'.$mensaje);
    }
    
    public function eliminar()
    {
        if(isset($_REQUEST['id']) && $_REQUEST['id']!=0){
            $id = ['id' => $_REQUEST['id']];
            $this->model->eliminar($id);
            $mensaje = 'mensaje=Se eliminaron los datos del empleado&color=alert-success';
        }else{
            $mensaje = 'mensaje=Los datos del empleado no se borraron&color=alert-danger';
        }

        header('Location: index.php?'.$mensaje);
    }
}