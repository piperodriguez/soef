<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<form>
			<div class="form-group">
				<label>Servicio perteneciente de la profesión</label>
				<?php
					require("../../../connect/config.php");
					$queryServicios= mysqli_query($cn, "SELECT id_servicio, nombre FROM servicios");
					$fetchServicios= mysqli_fetch_assoc($queryServicios);
				?>
				<select class="form-control" name="id_servicio" id="id_servicio">
					<option selected> </option>
					<?php do{ ?>
      				<option value="<?php echo $fetchServicios["id_servicio"];?>"><?php echo $fetchServicios["nombre"]; ?></option>
      				<?php } while($fetchServicios = mysqli_fetch_array($queryServicios));?>
      			</select>
			</div>
			<div class="form-group">
				<label for="nombre">Nombre Profesion</label>
				<input type="text" id="nombre" name="nombre" class="form-control">
			</div>
			<button class="crudInsertProfesion btn btn-dark">Guardar Profesion</button>
		</form>
	</div>
</div>

