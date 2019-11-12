<?php


$usuarioVacioError=false;  //usuario
$mailInvalido=false;  //validar
$contraseniaVaciaError=false;


// Persistencia

$password="";
$username="";
//ARRAY DE USUARIOS GUARDADOS
$usuarios = [];
$email="";


if(isset($_POST["submit"])) {
  if (empty($_POST["username"])){
    $usuarioVacioError = true;
  } else {
    $username=$_POST["username"];
  }
  if (!isset($_POST["email"]) || !filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
    $mailInvalido = true;
  }else {
    $email = $_POST["email"];
  }
  if (empty($_POST["password"])){
    $contraseniaVaciaError= true;
  } else {
    $password=$_POST["password"];
  }

  if (file_exists("usuarios.json")) {
    $usuariosJson=file_get_contents('usuarios.json');   //lee el archivo y lo trae como un texto... pero necesitamos un array para guardar todos los usuarios ya levantados
    $usuarios=json_decode($usuariosJson,true); //con json_decode lo pasamos a AARAY al texto

    //ver todos los usuarios para vr que nombre tienen asi no se repiten.
    foreach ($usuarios as $us) {
      if ($us["username"] == $username) {  //para cada usuario se ve que no tengan el mismo nombre que le pase previamente
        $usuarioVacioError=true;
        //echo "El nombre de usuario ya existe";
        break;//recorre el array hastaque encuentra el usuario
      }
    }
  }

//ENVIO DE DATOS . pregunto que no haya nada falso

// Evaluamos si no se produjo ningún error. Si esto es así, procedemos a procesar la información del formulario

if (!$usuarioVacioError && !$contraseniaVaciaError && !$mailInvalido){
  $md5Pass = md5($password); //MD5 ENCRIPTA
  $usuario = [
  "username"=>$username,
  "email"=>$email,
  "password"=>$md5Pass
  ];
  //TENEmos el array con los usuarios regitrados más el nuevo que acabamos de crear
  //necesitamos guardar como texto lo nuevo agregado
  $usuarios[]=$usuario;
  $usuariosJson = json_encode($usuarios,JSON_PRETTY_PRINT);
  //ahora levanta lo qe está en usuarios.json
  file_put_contents('usuarios.json',$usuariosJson);   //crea un archivo usuarios.json automaticamente al pasarlo como parametro
  header("Location:felicitaciones.php");
  exit;
}
}

 ?>
<!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One|Nixie+One|Suranna&display=swap" rel="stylesheet">

     <title>TPW</title>
   </head>

   <body>
     <header id="nav-bar">
       <nav class="navbar navbar-expand-lg fixed-top nav-down navbar-transparent" color-on-scroll="100" id="sectionsNav">
         <div class="container">
         <div class="navdar-tranlate">
             <a class="navbar-brand" href="index.php"><img src="image/tipografia.png" alt="brandlogo" height="40" width="150"></a>
         </div>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
           <i class="fa fa-bars"></i>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
           <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
             <li class="nav-item active">
               <a class="nav-link" href="index.php">Inicio</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="pf.php">Preguntas Frecuentes</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="login.php">Tu cuenta</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="register.php">Registro<span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item">
               <a class="btn btn-round" href="#" target="_blank">
               <i class="material-icons">add_shopping_cart</i>
               </a>
             </li>
           </ul>
         </div>
         </div>
        </nav>
    </header>

<section>
<div class="page-header header-filter">
  <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
            <form class="form" method="POST" action="">
              <div class="card card-login card-hidden">
                <div class="card-header card-header-primary text-center">
                  <h4 class="card-title">Bienvenidos</h4>
                  <!--<a class="brand"><img src="image/tipografia.png" alt="brand" height="45" width="150"></a> -->
                </div>
                <div class="card-body">
                  <p class="card-description text-center">Registrate</p>
                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">face</i>
                        </span>
                      </div>
                      <input type="text" class="form-control" name="username" value='<?= $username ?>' placeholder="Nombre de usuario"maxlength="15">
                      <?php if ($usuarioVacioError): ?>  <br>
                      <span id='register_username_errorloc' class='error'>El nombre del usuario ya existe</span>
                      <?php endif ?>
                    </div>
                  </span>

                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">email</i>
                        </span>
                      </div>
                      <?php if ($mailInvalido): ?>
                        <span>El email no cumple el formato</span>
                      <?php endif; ?>
                      <input type="email" class="form-control" name="email" value='<?= $email?>' placeholder="Correo electronico">
                      <span id='register_email_errorloc' class='error'></span>
                    </div>
                  </span>

                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock</i>
                        </span>
                      </div>
                      <?php if ($contraseniaVaciaError): ?>
                          <span>Debe indicar una contraseña</span>
                        <?php endif; ?>
                      <input type="password" class="form-control" name="password" value=""  placeholder="Contraseña" maxlength="15">
                      <div id='register_password_errorloc' class='error' style='clear:both'></div>
                    </div>
                  </span>
                  </div>
                <div class=" card-footer justify-content-center text-center">
                  <input type="submit"  class="btn btn-rose btn-link btn-lg" name='submit' value='Registrate'>

                </div>
                <div class="text-center text-muted pb-3"><a href="login.php" class="text-reset"> ¿Ya tenes una cuenta? Accedé desde acá.</a>
                </div>
              </div>
            </form>
          </div>
      </div>
  </div>
</div>
</section>

<footer>


</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   </body>
 </html>
