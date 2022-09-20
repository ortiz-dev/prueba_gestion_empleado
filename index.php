<?php

$controlador = 'empleado';

if(isset($_REQUEST['controlador'])){
    $controlador = $_REQUEST['controlador'];
    $accion = $_REQUEST['accion'] ? $_REQUEST['accion'] : 'index';
    $controlador = ucwords($controlador).'Controlador';
    require_once('Controladores/'.$controlador.'.php');
    $controlador = new $controlador;
    call_user_func( array( $controlador, $accion ) );

}else{
    $controlador = ucwords($controlador).'Controlador';
    require_once('Controladores/'.$controlador.'.php');
    $controlador = new $controlador;
    $controlador->index();
}

?>