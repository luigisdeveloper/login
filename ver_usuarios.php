<?php
	session_start();
	ob_start();
	if( !isset($_SESSION['usuario']) ){
	header('Location: ingresar');
	exit();
	}
	$titulo = "USUARIOS";
	include('config/conexion.php');
	include('include/header.php');

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		/*Filtro anti-XSS
		$usuario = htmlspecialchars(mysqli_real_escape_string($enlace, $usuario));
		$contrasena = htmlspecialchars(mysqli_real_escape_string($enlace, $contrasena));

		$query="SELECT * FROM  usuarios WHERE CORREO LIKE  '".htmlentities ($usuario)."'
		AND  `password` LIKE  '".htmlentities ($contrasena)."'LIMIT 0 , 30";
		*/

		//###### FILTRO anti-XSS
		$busqueda = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Busqueda']) );

		$sql = "SELECT * FROM usuario WHERE 
	    id LIKE '%".$busqueda."%' OR 
	    tipo_usuario LIKE '%".$busqueda."%' OR 
	    correo LIKE '%".$busqueda."%' OR
	    curp LIKE '%".$busqueda."%' OR
	    nombres LIKE '%".$busqueda."%' OR  
	    ape_mat LIKE '%".$busqueda."%' OR  
	    ape_pat LIKE '%".$busqueda."%' ";
		
		$resultadoEsp = mysqli_query($enlace, $sql);
		$count = mysqli_num_rows($resultadoEsp);
	}//Fin del if SERVER


//$query = "SELECT * FROM usuarios;";
//$resultado = mysqli_query($enlace, $query);
?>
    <div class="container z-depth-5">
      <?php
      if(isset($_SESSION['flash'])){
        if($_SESSION['flash']=='UsE'){
			echo '<div class="card red lighten-5 center">
					<div class="card-content red-text">
    					<p>Usuario Eliminado Correctamente...</p>
  					</div>
				</div>';
		}elseif($_SESSION['flash']=='UsEd'){
			echo '<div class="card amber lighten-5 center">
					<div class="card-content orange-text">
    					<p>Usuario Editado Correctamente...</p>
  					</div>
				</div>';
        }elseif($_SESSION['flash']=='UsA'){
			echo '<div class="card green lighten-5 center">
					<div class="card-content green-text">
    					<p>Usuario Agregado Correctamente...</p>
  					</div>
				</div>';
        }
        unset($_SESSION['flash']);
      }
      ?>


		<div class="row center">
	        <div class="col s12">
				<h2 class="z-depth-3 blue-grey lighten-2">Administración de Usuarios</h2>

				<br>
				<br>
				<?php if(isset($_SESSION['usuario'])) { 
					if($_SESSION['tipo'] === "Administrador") { ?>
				
					<a href="usuario_agregar" class="waves-effect orange lighten-2 btn"><i class="material-icons left">input</i>Agregar usuario</a>

					<!-- Modal Trigger -->
					<a class="waves-effect waves-light btn modal-trigger" href="#modal1"><i class="material-icons left">search</i>Todos los usuarios</a>

					<br>
					<br>

					<!-- Modal Structure -->
					<div id="modal1" class="modal bottom-sheet">
						<div class="modal-content">
							<h4>Todos los usuarios</h4>
							<?php
								$query = "SELECT * FROM usuario;";
								$resultado = mysqli_query($enlace, $query);
							?>
							<table class="bordered highlight striped centered responsive-table">
								<thead>
									<tr>
										<th>Id usuario</th>
										<th>Tipo de Usuario</th>
										<th>Curp</th>
										<th>Correo</th>
										<th>Nombre(s)</th>
										<th>Apellido Paterno</th>
										<th>Apellido Materno</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
								<?php while ($row = $resultado->fetch_object()){ ?>
									<tr>
										<td><?php echo $row->id ?>&nbsp;</td>
										<td><?php echo $row->tipo_usuario ?>&nbsp;</td>
										<td><?php echo $row->curp ?>&nbsp;</td>
										<td><?php echo $row->correo ?>&nbsp;</td>										<td><?php echo $row->correo ?>&nbsp;</td>
										<td><?php echo $row->nombres ?>&nbsp;</td>
										<td><?php echo $row->ape_pat ?>&nbsp;</td>
										<td><?php echo $row->ape_mat ?>&nbsp;</td>
										<td>
											<a href="usuario_ver?id=<?= $row->id ?>" class="btn green" title="Ver usuario">Detalles</a>
											<a href="usuario_editar?id=<?= $row->id ?>" class="btn yellow darken-1" title="Editar usuario">editar</a>
											<button type="button" class="btn red" onclick="confirmacion('<?php echo $row->nombres; ?>', '<?php echo $row->ape_pat; ?>', <?php echo $row->id; ?> )" title="Eliminar usuario">Borrar</button>
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
						</div>
					</div>

					<form action="" method="POST">

						<div class="input-field">
						  <i class="material-icons prefix">perm_identity</i>
						  <input type="text" name="Busqueda" id="Busqueda" class="validate" required>
						  <label for="Busqueda" data-error="Error" data-success="Correcto">Buscar usuario</label>
						</div>

						<br>
						<br>
						<button class="btn waves-effect brown" type="submit">Buscar
							<i class="material-icons right">send</i>
						</button>
						<!--<a href="ver_usuarios" class="btn waves-effect waves-light red" role="button">Cancelar</a>-->
					</form>
					<!--<button type="button" class="btn btn-primary btn-sm" onclick="location.href='clientes_agregar'">Agregar Nueva</button><br><br>
					-->
					<br>
					<br>
					<?php if(isset($count)) { 
						if($count > 0) { ?> 
							<table class="bordered highlight striped centered responsive-table">
								<thead>
									<tr>
										<th>Id usuario</th>
										<th>Tipo de Usuario</th>
										<th>Curp</th>
										<th>Correo</th>
										<th>Nombre(s)</th>
										<th>Apellido Paterno</th>
										<th>Apellido Materno</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
								<?php while ($row = $resultadoEsp->fetch_object()){ ?>
									<tr>
										<td><?php echo $row->id ?>&nbsp;</td>
										<td><?php echo $row->tipo_usuario ?>&nbsp;</td>
										<td><?php echo $row->curp ?>&nbsp;</td>
										<td><?php echo $row->correo ?>&nbsp;</td>
										<td><?php echo $row->nombres ?>&nbsp;</td>
										<td><?php echo $row->ape_pat ?>&nbsp;</td>
										<td><?php echo $row->ape_mat ?>&nbsp;</td>
										<td>
											<a href="usuario_ver?id=<?= $row->id ?>" class="btn green" title="Ver usuario">Detalles</a>
											<a href="usuario_editar?id=<?= $row->id ?>" class="btn yellow darken-1" title="Editar usuario">Editar</a>
											<button type="button" class="btn red" onclick="confirmacion('<?php echo $row->nombres; ?>', '<?php echo $row->ape_pat; ?>', <?php echo $row->id; ?> )" title="Eliminar usuario">Borrar</button>
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						<?php }else{
							echo '<div class="card amber lighten-4 center">
	             						<div class="card-content red-text">
	                    				<p>Busca de nuevo; Usuario inexistente...</p>
	                  				</div>
	                			</div>';
						} 
					}?>

					<br>
					<br>
				<?php 	}else{
							echo '<div class="card red center">
									<div class="card-content white-text">
				    					<p>ERROR NO tienes los permisos necesarios...</p>
				  					</div>
								</div>';
						}
				}else{
					echo '<div class="card red lighten-5 center">
							<div class="card-content red-text">
		    					<p>ERROR...</p>
		  					</div>
						</div>';
				} ?>
			</div>
	  	</div>
    </div><!-- CONTAINER -->

     <script>
		function confirmacion(nomb, apee, idd) {
			if(confirm("Realmente deseas eliminar al usuario " + nomb + " " + apee + " Con el Id: " + idd + " ?"))
			{
				window.location.href="usuario_eliminar?id=" + idd;
			}
		}

		//<!--A CONTINUACION SCRIPT PARA INICIALIZAR ELMODAL-->
		$(document).ready(function(){
			// the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
			$('.modal').modal();
		});
    </script>

<?php include('include/footer.php') ?>
