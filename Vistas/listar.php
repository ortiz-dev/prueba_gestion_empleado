<h2>Lista Empleados</h2>
<a  class="btn btn-primary float-right" href="?controlador=empleado&accion=editar&id=0"><i class="bi bi-person-plus-fill"></i> Crear</a>
<?php if(isset($_REQUEST['mensaje'])): ?>
<div id="msg-alerta" class="alert <?php echo $_REQUEST['color'] ?>" role="alert">
	<?php echo $_REQUEST['mensaje'] ?>
</div>
<?php endif; ?>
<table class="table table-striped">
	<thead>
		<th scope="col"><i class="bi bi-person-fill"></i> Nombre</th>
		<th scope="col"><i class="bi bi-at"></i> Email</th>
		<th scope="col"><i class="bi bi-gender-ambiguous"></i> Sexo</th>
		<th scope="col"><i class="bi bi-briefcase-fill"></i> Area</th>
		<th scope="col"><i class="bi bi-envelope-fill"></i> Boletin</th>
		<th scope="col">Modificar</th>
		<th scope="col">Eliminar</th>
	</thead>
	<tbody>
		<?php foreach ($empleados as $empleado): ?>
		<tr>
			<td><?php echo $empleado['nombre'] ?></td>
			<td><?php echo $empleado['email'] ?></td>
			<td><?php echo $empleado['sexo'] ?></td>
			<td><?php echo $empleado['area_id'] ?></td>
			<td><?php echo $empleado['boletin'] ?></td>
			<td>
				<a  class="btn btn-dark" href="?controlador=empleado&accion=editar&id=<?php echo $empleado['id']; ?>"><i class="bi bi-pencil-square"></i></a>
			</td>
			<td>
				<a  class="btn btn-dark" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?controlador=empleado&accion=eliminar&id=<?php echo $empleado['id']; ?>"><i class="bi bi-trash3-fill"></i></a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
