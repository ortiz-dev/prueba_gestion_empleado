    <?php 
        if(isset($respuesta['empleado'])){
            $empleado = $respuesta['empleado']; 
            $empleado_rol = $respuesta['empleado_rol']; 
        }else{
            $empleado = [];
            $empleado_rol = [];
        }
        $areas = isset($respuesta['areas']) ? $respuesta['areas'] : []; 
        $roles = isset($respuesta['roles']) ? $respuesta['roles'] : []; 
    ?>
    <h3>
        <?php echo isset($empleado['id']) ? 'Modificar Empleado' : 'Crear Empleado'; ?>
    </h3>

    <div class="alert alert-primary" role="alert">
        Los campos con astriscos(*) son obligatorios
    </div>
    <form id="frm-empleado" action="?controlador=empleado&accion=guardar" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo isset($empleado['id']) ? $empleado['id'] : 0; ?>" />
        <div class="form-group row">
            <label for="nombre" class="col-sm-2 col-form-label text-right" >Nombre completo *</label>
            <div class="col-sm-8">
            <span id="error-nombre" class="alert-danger invisible">No se permiten caracteres especiales ni numeros</span>
                <input type="text" name="nombre" id="nombre" value="<?php echo isset($empleado['nombre']) ? $empleado['nombre'] : ''; ?>" class="form-control" placeholder="Nombre completo del emplado" >
            </div>
        </div>
        
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label text-right">Correo eléctronico *</label>
            <div class="col-sm-8">
            <span id="error-email" class="alert-danger invisible">El email ingresado no cumple el formato pepito@example.com</span>
                <input type="email" name="email" id="email" value="<?php echo isset($empleado['email']) ? $empleado['email'] : ''; ?>" class="form-control" placeholder="Correo eléctronico">
            </div>
        </div>

        
        <fieldset class="form-group">
            <div class="row">
            <legend class="col-form-label col-sm-2 pt-0 text-right">Sexo *</legend>
            <div class="col-sm-10">
              <span id="error-sexo" class="alert-danger invisible">No ha seleccionado el sexo</span>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="femenino" value="F" <?php echo isset($empleado['sexo']) && $empleado['sexo']=='F' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="femenino">
                        Femenino
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="masculino" value="M" <?php echo isset($empleado['sexo']) && $empleado['sexo']=='M' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="masculino">
                        Masculino
                    </label>
                </div>
               </div>
            </div>
        </fieldset>
        

        <div class="form-group row">
            <label for="area" class="col-sm-2 col-form-label text-right">Area *</label>
            <div class="col-sm-8">
            <span id="error-area" class="alert-danger invisible">Debe seleccionar al menos un area</span>
                <select name="area_id" id="area_id" class="form-control">
                    <option value="">-- seleccione --</option>
                    <?php foreach($areas as $area): ?>
                        <option value="<?php echo $area['id']; ?>" <?php echo isset($empleado['area_id']) && $area['id']==$empleado['area_id'] ? 'selected' : ''; ?>><?php echo $area['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>    
            </div>
        </div>

        <div class="form-group row">
            <label for="descripcion" class="col-sm-2 col-form-label text-right">Descripcion *</label>
            <div class="col-sm-8">
                <span id="error-descripcion" class="alert-danger invisible">Debe ingresar la descripcion</span>
                <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion de la experiencia del empleado"><?php echo isset($empleado['descripcion']) ? $empleado['descripcion'] : '' ?></textarea>    
            </div>
        </div>

        <fieldset class="form-group">
            <div class="row">
            <legend class="col-form-label col-sm-2 pt-0 text-right"></legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="boletin" value="<?php echo isset($empleado['boletin']) && $empleado['boletin'] ? 1 : 0; ?>" id="boletin" <?php echo isset($empleado['boletin']) && $empleado['boletin'] ? 'checked' : ''; ?> >
                    <label class="form-check-label" for="boletin">
                        Deseo recibir boletín informativo
                    </label>
                </div>
            </div>
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="row">
            <legend class="col-form-label col-sm-2 pt-0 text-right">Roles *</legend>
            <div class="col-sm-10">
              <span id="error-roles" class="alert-danger invisible">Debe seleccionar al menos uno de los roles</span>
                <?php $contador=0; foreach($roles as $rol):  $activo = 0; $contador++; ?>
                    <?php foreach($empleado_rol as $emp_rol): 
                         if($emp_rol['rol_id']==$rol['id']):  
                            $activo = 1;
                        ?>    
                        <?php 
                         endif; 
                     endforeach; ?>
                    <div class="form-check">
                        <input class="form-check-input rol-emp" type="checkbox" name="roles[<?php echo $contador ?>]" value="<?php echo $rol['id'] ?>" <?php echo $activo==1 ? 'checked' : '' ?> id="<?php echo $rol['nombre'] ?>" >
                        <label class="form-check-label" for="<?php echo $rol['nombre'] ?>">
                            <?php echo $rol['nombre'] ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            </div>
        </fieldset>
        
        
        <fieldset class="form-group">
            <div class="row">
            <legend class="col-form-label col-sm-2 pt-0 text-right">
                <a href="index.php">Regresar</a>
            </legend>
            <div class="col-sm-10">
                <button class="btn btn-primary">Guardar</button>
            </div>
            </div>
        </fieldset>

    </form>

