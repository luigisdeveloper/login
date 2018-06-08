<?php
session_start();
ob_start();
if( !isset($_SESSION['usuario']) ){
  header('Location: ingresar');
  exit();
}
$titulo = "Editar Usuario";
include('config/conexion.php');
include ('include/header.php');
$query = "SELECT * FROM usuario WHERE id =" . $_GET['id'] . "";
$resultado = mysqli_query($enlace, $query);
$usuario = $resultado->fetch_object();
if (empty($usuario)) {
	exit();
}

?>
    <div class="container">
	    <div class="row">

        <?php if(isset($_SESSION['usuario'])) { 
					if($_SESSION['tipo'] === "Administrador") { ?>

			<div class="col s3">

			</div>
			<div class="col 16 s6 center">

				<h2 class="header orange-text">Detalles del Usuario <?php if(isset($usuario->nombres)) echo $usuario->nombres; ?></h2>
			    <div class="card horizontal z-depth-4">

			      <div class="card-stacked">
			        <div class="card-content">
						<form action="" method="">

							<div class="input-field">
							  <i class="material-icons prefix">perm_identity</i>
							  <input type="text" name="Id_usuario" id="Id_usuario" value="<?php if(isset($usuario->id)) echo $usuario->id; ?>" readonly>
							  <label for="Id_usuario">Id Usuario(s)</label>
							</div>

							<div class="input-field">
							  <i class="material-icons prefix">perm_identity</i>
							  <input type="text" name="Nombres" id="Nombres" value="<?php if(isset($usuario->nombres)) echo $usuario->nombres; ?>" readonly>
							  <label for="Nombres">Nombre(s)</label>
							</div>

							<div class="input-field">
							  <i class="material-icons prefix">perm_identity</i>
							  <input type="text" name="Ape_pat" id="Ape_pat" value="<?php if(isset($usuario->ape_pat)) echo $usuario->ape_pat; ?>" readonly>
							  <label for="Ape_pat">Apellido paterno</label>
							</div>

							<div class="input-field">
							  <i class="material-icons prefix">perm_identity</i>
							  <input type="text" name="Ape_mat" id="Ape_mat" value="<?php if(isset($usuario->ape_mat)) echo $usuario->ape_mat; ?>" readonly>
							  <label for="Ape_mat">Apellido materno</label>
							</div>

							<div class="input-field">
							  <i class="material-icons prefix">email</i>
							  <input type="text" name="Correo" id="Correo" value="<?php if(isset($usuario->correo)) echo $usuario->correo; ?>" readonly>
							  <label for="Correo" >Correo</label>
							</div>

							<div class="input-field">
							  <i class="material-icons prefix">email</i>
							  <input type="text" name="Curp" id="Curp" value="<?php if(isset($usuario->curp)) echo $usuario->curp; ?>" readonly>
							  <label for="Curp" >Curp</label>
							</div>

							<div class="input-field">
							  <i class="material-icons prefix">https</i>
							  <input type="text" name="Tipo" id="Tipo" value="<?php if(isset($usuario->tipo_usuario)) echo $usuario->tipo_usuario; ?>" readonly>
							  <label for="Tipo">Tipo de Usuario</label>
							</div>					
						</form>
			        </div>
			        <div class="card-action">
						<a href="ver_usuarios" class="btn waves-effect waves-light red" role="button">Atrás</a>
			        </div>
			      </div>
			    </div>
			</div>
			<div class="col s3">
			  
			</div>


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
<?php include('include/footer.php') ?>