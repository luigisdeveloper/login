<?php
  session_start();
  ob_start();
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../config/conexion.php');

    if(isset($_SESSION['usuario'])){
      session_destroy();
    }

      /*Filtro anti-XSS
      $usuario = htmlspecialchars(mysqli_real_escape_string($enlace, $usuario));
      $contrasena = htmlspecialchars(mysqli_real_escape_string($enlace, $contrasena));

      $query="SELECT * FROM  usuarios WHERE CORREO LIKE  '".htmlentities ($usuario)."'
      AND  `password` LIKE  '".htmlentities ($contrasena)."'LIMIT 0 , 30";
      */

      //###### FILTRO anti-XSS
      $correo = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Correo']) );
      $pass = htmlspecialchars( mysqli_real_escape_string($enlace, $_POST['Contrasena']) );
      
      //$sql = "SELECT * FROM usuario WHERE correo = '$correo' and contrasena = '$pass' COLLATE utf8_bin ";
      //$sql = "SELECT * FROM usuario WHERE correo = '$correo' and contrasena = BINARY '$pass' ";
      //$sql = "SELECT * FROM usuario WHERE correo = '".htmlentities($correo)."' 
      //AND contrasena = BINARY '".htmlentities($pass)."' ";
      $sql = "SELECT * FROM usuario WHERE correo = '".htmlentities($correo)."' ";
      
      $result = mysqli_query($enlace,$sql);
      //la siguiente linea funciona igual a la que continúa después
      //$count = $result->num_rows;
      $count = mysqli_num_rows($result);
      

      if($count == 0){
        $_SESSION['flash'] = "Error_correo";
      ///  header("location: ../index");
      }elseif($count == 1) {
        //echo("Si hay correo: $count");
        //Esta linea da el mismo resultado que la siguiente
        //$fila_resultante = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $fila_resultante = mysqli_fetch_assoc($result);
        //echo($fila_resultante["Contrasena"]);
        //$passCifrado = password_hash($pass, PASSWORD_DEFAULT);
        if( password_verify( $pass, $fila_resultante['contrasena']) ) {
          $_SESSION['usuario'] = $fila_resultante["id"];
          $_SESSION['tipo'] = $fila_resultante["tipo_usuario"];
          $_SESSION['curp'] = $fila_resultante["curp"];
          $_SESSION['correo'] = $fila_resultante["correo"];
          $_SESSION['nombres'] = $fila_resultante["nombres"];
          $_SESSION['ape_pat'] = $fila_resultante["ape_pat"];
          $_SESSION['ape_mat'] = $fila_resultante["ape_mat"];
        }else{
          $_SESSION['flash'] = "Error_contrasena";
          header("location: ../index");
        } //Fin verificacion de contraseña
      }// fin del if
      header("location: ../index");
   }//Fin del if SERVER
?>