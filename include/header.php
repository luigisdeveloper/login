<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <title><?php echo $titulo; ?> - INICIO </title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!--  Scripts-->
  <script src="js/jquery.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script src="js/init.js"></script>
</head>

<body>
<!--BOTON QUE DESPLIEGA EL MENU NORMAL-->
  <!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <!-- AQUI SE PUEDEN INSERTAR FILAS DE LISTAS PARA AGREGAR MENÚS DEL TIPO OPERADOR O USUARIO NORMAL-->
  <?php if($_SESSION['tipo'] === "Administrador") { ?>
    <!-- AQUI SE PUEDEN INSERTAR FILAS DE LISTAS PARA AGREGAR MENÚS DEL TIPO ADMINISTRADOR-->
    <li><a href="ver_usuarios">Usuarios</a></li>
  <?php } ?>
</ul>
<!--FINAL DEL BOTON QUE DESPLIEGA EL MENU-->
<div class="navbar">
  <nav class="blue darken-3" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index" class="brand-logo"><i class="material-icons">payment</i>TITULO DE EMPRESA</a>
      <?php if(isset($_SESSION['usuario'])){ ?>
        <ul class="right hide-on-med-and-down">
           <!-- Dropdown Trigger -->
           <!-- CREA LOS MENUS EN PANTALLA NORMAL, CON ACCIÓN DROPDOWN -->
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Administrar<i class="material-icons right">arrow_drop_down</i></a></li>
          <li><a href="salir"><i class="material-icons left">stop</i>Salir</a></li>
        </ul>
        <!-- MENU QUE ENTRA EN ACCIÓN CUANDO ESTÁ EN MODO RESPONSIVE 
            O PANTALLA PEQUEÑA TIPO CELULAR O TABLETA -->
        <ul id="nav-mobile" class="side-nav">
          <!--VERIFICA SI TIENE PERMISOS DE ADMINISTRADOR PARA MOSTRAR OPCION DE REGISTRAR, EDITAR
              O ELIMINAR USUARIOS Y PEDIDOS-->
          <?php if($_SESSION['tipo'] === "Administrador") { ?>
            <li><a href="ver_usuarios"><i class="material-icons left">search</i>Usuarios</a></li>
          <?php } ?>
          <li><a href="salir"><i class="material-icons left">stop</i>Salir</a></li>
        </ul>
      <?php } ?>
      <a href="index" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
</div>
