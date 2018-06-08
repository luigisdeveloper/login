<?php
  session_start();
  ob_start();
  $titulo = "INGRESAR";
  include('include/header.php');
  
  if(isset($_SESSION['usuario'])){
    session_destroy();
  }
?>
  <div class="container">
      <?php
      if(isset($_SESSION['flash'])){
        if($_SESSION['flash'] === 'Error_correo'){
          echo '<div class="card red lighten-4 center">
                  <div class="card-content red-text">
                    <p>ERROR: Correo inexistente...</p>
                  </div>
                </div>';
        }elseif ($_SESSION['flash'] === 'Error_contrasena') {
          echo '<div class="card red center">
                  <div class="card-content white-text">
                    <p><i class="mdi-alert-error"></i>ERROR: Contraseña inválida...</p>
                  </div>
                </div>';
        }
        unset($_SESSION['flash']);
      }
      ?>
      <div class="row">
        
        <div class="col s3">
          
        </div>

        <div class="col l6 s6 center">

          <h2 class="header orange-text">Iniciar Sesion</h2>
            
          <form action="include/valida_usuario" method="POST">
            <div class="input-field">
              <i class="material-icons prefix">email</i>
              <input type="email" name="Correo" id="Correo" class="validate" required>
              <label for="Correo" data-error="Error" data-success="Correcto">Correo</label>
            </div>
            <div class="input-field">
              <i class="material-icons prefix">lock</i>
              <input type="password" name="Contrasena" id="Contrasena" class="validate" required>
              <label for="Contrasena">Contraseña</label>
            </div>
            
              <button class="btn waves-effect waves-light" type="submit">Entrar
                <i class="material-icons right">send</i>
              </button>
              <!--<a href="index" class="btn waves-effect waves-light red" role="button">Cancelar</a>-->
              <br>
          </form>
        </div>

        <div class="col s3">
          
        </div>

      </div>
        <!-- <a href="formRegistroDeUsuarios.php" style = "color: blue; font-size: 10pt;" >Registrar nuevo usuario</a> -->
  </div>
<?php include('include/footer.php') ?>
