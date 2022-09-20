
setTimeout(function(){
    let notificacion = document.querySelector('#msg-alerta');
    if(notificacion){
        let clases = notificacion.className;
        notificacion.className = clases + ' invisible';
    }
},4000);

let formulario = document.querySelector('#frm-empleado');
if(formulario){
    formulario.addEventListener(
        'submit',
        (e)=>{
            if(!validarFormulario()){
                e.preventDefault();
            }
        }
    );
}

function validarFormulario(){
    let nombre = document.querySelector('#nombre');
    let email = document.querySelector('#email');
    let femenino = document.querySelector('#femenino');
    let masculino = document.querySelector('#masculino');
    let area = document.querySelector('#area_id');
    let descripcion = document.querySelector('#descripcion');
    let roles = document.querySelectorAll('.rol-emp');
    if(!validaNombre(nombre.value)){
        document.querySelector('#error-nombre').className = 'alert-danger';
        return false;
    }else if(!validaEmail(email.value)){
        document.querySelector('#error-email').className = 'alert-danger';
        return false;
    }else if(!validaSexo(femenino, masculino)){
        document.querySelector('#error-sexo').className = 'alert-danger';
        return false;
    }else if(!validaArea(area)){
        document.querySelector('#error-area').className = 'alert-danger';
        return false;
    }else if(!validaDescripcion(descripcion)){
        document.querySelector('#error-descripcion').className = 'alert-danger';
        return false;
    }else if(!validaRoles(roles)){
        document.querySelector('#error-roles').className = 'alert-danger';
        return false;
    }else{
        return true;
    }
}

function validaNombre(nombre){
    let regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/g;
    $('.popover-dismiss').popover('show')
    return regex.test(nombre);
}

function validaEmail(email){
    let regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    return regex.test(email);
}

function validaSexo(femenino, masculino){
    if(femenino.checked || masculino.checked){
        return true;
    }else{
        return false;
    }

}

function validaArea(area){
    if(area.value!=''){
        return true;
    }else{
        return false;
    }
}

function validaDescripcion(descripcion){
    if(descripcion.value!=''){
        return true;
    }else{
        return false;
    }
}

function validaRoles(roles){
    $activo = false;
    roles.forEach(($v)=>{
        if($v.checked){
            $activo = true;
        }
    });
    return $activo;
}

document.addEventListener('click', limpiarAlerta);

function limpiarAlerta(){
    let datos = document.querySelectorAll('.alert-danger');
    datos.forEach(function($v){
        $v.className = 'alert-danger invisible';
    });
}
