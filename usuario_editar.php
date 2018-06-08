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
if (!empty($_POST)) {

	$id = htmlspecialchars( mysqli_real_escape_string($enlace, $_GET['id']) );
	$tipo = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Tipo']) );
	$curp = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Curp']) );
	$correo = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Correo']) );
	$contrasena = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Contrasena']) );
	$contrasena2 = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Contrasena2']) );
	$nombres = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Nombres']) );
	$ape_pat = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Ape_pat']) );
	$ape_mat = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Ape_mat']) );
	
	//Checa si el cooreo editado existe	
	$sql_Check_Mail = "SELECT * FROM usuario WHERE correo = '".htmlentities($correo)."' AND id = '".htmlentities($id)."' ";
	$result = mysqli_query($enlace, $sql_Check_Mail);
	$count = mysqli_num_rows($result);

	function actualiz($i,$t,$cu,$c,$cont,$n,$ap,$am,$e){
		$query = "UPDATE `usuario` SET `id` =  '" . $i . "',`tipo_usuario` = '" . $t . "',
	    `curp` = '" . $cu . "',`correo` = '" . $c . "',`contrasena` = '" . $cont . "',`nombres` = '" . $n . "',`ape_pat` = '" . $ap . "',`ape_mat` = '" . $am . "' WHERE `id` =" . $_GET['id'] . "";
		$resultado = mysqli_query($e, $query);
		if ($resultado) {
			$_SESSION['flash'] = "UsEd";
			echo ' <script language="javascript">alert("Usuario Actualizado con éxito");</script> ';
			header("Location: ver_usuarios");
			exit();
		}
	}

	if($count > 0){
		if($contrasena === $contrasena2){
			if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
				$passCifrado = password_hash($contrasena, PASSWORD_DEFAULT);
				actualiz($id,$tipo,$curp,$correo,$passCifrado,$nombres,$ape_pat,$ape_mat,$enlace);
			}else{
				echo ' <script language="javascript">alert("ingrese correo valido, vuelve a intentarlo");</script> ';
			}
		}else{
			echo ' <script language="javascript">alert("Las contraseñas no coinciden, vuelve a intentarlo");</script> ';
		}
	}else{
		$sql_Check_Mail = "SELECT * FROM usuario WHERE correo = '".htmlentities($correo)."' ";
		$result_2 = mysqli_query($enlace, $sql_Check_Mail);
		$count_2 = mysqli_num_rows($result_2);

		if($count_2 > 0){
			echo ' <script language="javascript">alert("Correo usado por otro usuario, vuelve a intentarlo");</script> ';
		}else{
			if($contrasena === $contrasena2){
				if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
					$passCifrado = password_hash($contrasena, PASSWORD_DEFAULT);
					actualiz($id,$tipo,$curp,$correo,$passCifrado,$nombres,$ape_pat,$ape_mat,$enlace);
				}else{
					echo ' <script language="javascript">alert("ingrese correo valido, vuelve a intentarlo");</script> ';
				}
			}else{
				echo ' <script language="javascript">alert("Las contraseñas no coinciden, vuelve a intentarlo");</script> ';
			}
		}
	}
}
?>
    <div class="container">
	    <?php
	    	if(isset($_SESSION['flash'])){
	    	if($_SESSION['flash']=='Error'){
	        	echo '<span class="new badge red" data-badge-caption="custom caption">4</span>';
	        }
	        unset($_SESSION['flash']);
	    }
	    ?>
	    <div class="row">
	    	
        <?php if(isset($_SESSION['usuario'])) { 
					if($_SESSION['tipo'] === "Administrador") { ?>

			<div class="col s3">
			  
			</div>
			<div class="col 16 s6 center">
				<h2 class="header orange-text">Editar Usuario <?php if(isset($usuario->nombres)) echo $usuario->nombres; ?></h2>

				<p class="teal-text">Puedes modificar cualquier campo...</p>
				<form action="" method="POST">

					<select class="browser-default" id="Tipo" name="Tipo">
						<option disabled selected>Elige el tipo de usuario</option>
						<option >Administrador</option>
						<option selected>Empleado</option>
					</select>

					<div class="input-field">
					  <i class="material-icons prefix">perm_identity</i>
					  <input type="text" name="Nombres" id="Nombres" class="validate" value="<?php if(isset($usuario->nombres)) echo $usuario->nombres; ?>" required>
					  <label for="Nombres" data-error="Error" data-success="Correcto">Nombre(s)</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">perm_identity</i>
					  <input type="text" name="Ape_pat" id="Ape_pat" class="validate" value="<?php if(isset($usuario->ape_pat)) echo $usuario->ape_pat; ?>" required>
					  <label for="Ape_pat" data-error="Error" data-success="Correcto">Apellido paterno</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">perm_identity</i>
					  <input type="text" name="Ape_mat" id="Ape_mat" class="validate" value="<?php if(isset($usuario->ape_mat)) echo $usuario->ape_mat; ?>" required>
					  <label for="Ape_mat" data-error="Error" data-success="Correcto">Apellido materno</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">email</i>
					  <input type="text" name="Curp" id="Curp" class="validate" value="<?php if(isset($usuario->curp)) echo $usuario->curp; ?>" required>
					  <label for="Curp" data-error="Error" data-success="Correcto">Curp</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">email</i>
					  <input type="text" name="Correo" id="Correo" class="validate" value="<?php if(isset($usuario->correo)) echo $usuario->correo; ?>" required>
					  <label for="Correo" data-error="Error" data-success="Correcto">Correo</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">https</i>
					  <input type="password" name="Contrasena" id="Contrasena" class="validate" required>
					  <label for="Contrasena">Nueva Contraseña</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">https</i>
					  <input type="password" name="Contrasena2" id="Contrasena2" class="validate" required>
					  <label for="Contrasena2">Repite la nueva Contraseña</label>
					</div>					

					<br>
					<br>
					<button class="btn waves-effect waves-light" type="submit">Actualizar
						<i class="material-icons right">send</i>
					</button>
					<a href="ver_usuarios" class="btn waves-effect waves-light red" role="button">Cancelar</a>
					<br>
				</form>
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