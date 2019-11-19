<?php
  include("soporte.php");
  if (!$auth->estaLogueado()) {  //Si el usuario no está logueado...
    header("Location:login.php");exit;
  }

  $usuarioLogueado = $auth->usuarioLogueado($db);

  $nombre = $usuarioLogueado->getUsername();

?>

<?php include("nav/layout.php"); ?>

<h1>Inicio</h1>
<h2>Bienvenido <?=$nombre?> a tu perfil</h2>


<?php include("nav/footer.php"); ?>
