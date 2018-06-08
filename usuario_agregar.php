<?php
	session_start();
	ob_start();
	if( !isset($_SESSION['usuario']) ){
	header('Location: ingresar');
	exit();
	}
	$titulo = "REGISTRAR USUARIO";
	include('config/conexion.php');
	include('include/header.php');
	
   //if(isset($_SESSION['usuario'])){
   //  session_destroy();
   //}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		/*Filtro anti-XSS
		$usuario = htmlspecialchars(mysqli_real_escape_string($enlace, $usuario));
		$contrasena = htmlspecialchars(mysqli_real_escape_string($enlace, $contrasena));

		$query="SELECT * FROM  usuario WHERE CORREO LIKE  '".htmlentities ($usuario)."'
		AND  `password` LIKE  '".htmlentities ($contrasena)."'LIMIT 0 , 30";
		*/

		//###### FILTRO anti-XSS
		$nombre = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Nombres']) );
		$ape_pat = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Ape_pat']) );
		$ape_mat = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Ape_mat']) );
		$curp = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Curp']) );
		$correo = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Correo']) );
		$contrasena = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Contrasena']) );
		$contrasena2 = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Contrasena2']) );
      	$tipo = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Tipo']) );
      	//echo "Tipo: $tipo";
      //$sql_Check_Mail = "SELECT * FROM usuario WHERE correo = '$correo' and contrasena = '$contrasena' COLLATE utf8_bin ";
      //$sql_Check_Mail = "SELECT * FROM usuario WHERE correo = '$correo' and contrasena = BINARY '$contrasena' ";
		$sql_Check_Mail = "SELECT * FROM usuario WHERE correo = 'htmlentities($correo)'; ";
		
		$result = mysqli_query($enlace, $sql_Check_Mail);
      //la siguiente linea funciona igual a la que continúa después
      //$count = $result->num_rows;
		$count = mysqli_num_rows($result);

		if($contrasena == $contrasena2){
			if($count > 0){
				$_SESSION['flash'] = "Error";
			}else {
				if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
					$passCifrado = password_hash($contrasena, PASSWORD_DEFAULT);
					/*
					if ($tipo == "Administrador"){
						$tip = 1;
					}elseif($tipo == "Usuario") {
						$tip = 2;
					}
					*/
					//var_dump($nombre, $ape_pat, $ape_mat, $curp, $correo, $contrasena, $tipo, $passCifrado);
					$sql_insert = "INSERT INTO usuario VALUES('','$tipo','$curp','$correo','$passCifrado','$nombre','$ape_pat','$ape_mat');";
					mysqli_query($enlace,$sql_insert)
						or die("ERROORRR");
					//$sql = "INSERT INTO `usuario` (`id`, `tipo_usuario`, `curp`, `correo`, `contrasena`, `nombres`, `ape_pat`, `ape_mat`) VALUES (NULL, \'admin\', \'hjc\', \'co\', \'lalala\', \'l\', \'l\', \'l\')";
					//echo 'Se ha registrado con exito';
					echo ' <script language="javascript">alert("Usuario registrado con éxito");</script> ';
/*
					$_SESSION['flash'] = "UsA";
					//echo "<script>location.href='usuarios'</script>";
					header("Location: ver_usuarios");
					exit();
*/
				}else{
					echo '<div class="alert alert-danger"><strong>Error!</strong> No es un correo...</div>';
				}
				
			}// fin del if count
		}else{
			echo '<div class="alert alert-danger"><strong>Error!</strong> Las contraseñas son distintas</div>';
		}//fin total del if checa contraseña
   }//Fin del if SERVER
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
				<h2 class="header orange-text">Registrar Nuevo Usuario</h2>

				<form action="" method="POST">

					<select class="browser-default" id="Tipo" name="Tipo">
						<option disabled>Elige el tipo de usuario</option>
						<option >Administrador</option>
						<option selected >Empleado</option>
					</select>

					<div class="input-field">
					  <i class="material-icons prefix">perm_identity</i>
					  <input type="text" name="Nombres" id="Nombres" class="validate" required>
					  <label for="Nombres" data-error="Error" data-success="Correcto">Nombre(s)</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">perm_identity</i>
					  <input type="text" name="Ape_pat" id="Ape_pat" class="validate" required>
					  <label for="Ape_pat" data-error="Error" data-success="Correcto">Apellido Materno</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">perm_identity</i>
					  <input type="text" name="Ape_mat" id="Ape_mat" class="validate" required>
					  <label for="Ape_mat" data-error="Error" data-success="Correcto">Apellido Materno</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">email</i>
					  <input type="text" name="Curp" id="Curp" class="validate" required>
					  <label for="Curp" data-error="Error" data-success="Correcto">Curp</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">email</i>
					  <input type="text" name="Correo" id="Correo" class="validate" required>
					  <label for="Correo" data-error="Error" data-success="Correcto">Correo</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">https</i>
					  <input type="password" name="Contrasena" id="Contrasena" class="validate" required>
					  <label for="Contrasena">Contraseña</label>
					</div>

					<div class="input-field">
					  <i class="material-icons prefix">https</i>
					  <input type="password" name="Contrasena2" id="Contrasena2" class="validate" required>
					  <label for="Contrasena2">Repite la contraseña</label>
					</div>					

					<br>
					<br>
					<button class="btn waves-effect waves-light" type="submit">Agregar
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