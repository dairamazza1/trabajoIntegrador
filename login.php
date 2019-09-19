<?php

$username="";
$password="";

$nombreVacioError = false;
$contraseniaVaciaError= false;





$archivo='usuarios.json';
if(file_exists($archivo)){
  $usuariosJson=file_get_contents($archivo);
  $usuarios= json_decode($usuariosJson,true);
  $usuarioExiste=false; //declaro que es falso y si existe se convierte en verdadero

  foreach ($usuarios as $usuario) {//recorre el array con todos los usuarios
   if($usuario['username']==$username){ //el nombre del usuario es igual al que paso en el formulario?.. Sino lo es, tiene que pasar al siguinte usuario
     $usuarioExiste=true;
     $contraseniaEncriptada=md5($contrasenia);//si el usuario existe hay que encriptar la contraseña
     if($usuario['password']==$contraseniaEncriptada){
       header("Location:felicitaciones.php");
       exit;
     }
     else{
       $contraseniaIncorrectaError=true;  //pass invalido
       break;
     }
   }
  }
  if(!$usuarioExiste){  //si el usuario no existe...
    $usuarioNoExisteError=true;
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
     <title>Mi proyecto</title>
   </head>

   <body>
   <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <a class="navbar-brand" href="index.html"><img src="image/brand.png" alt="brandlogo" height="45" width="45"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pf.html">Preguntas Frecuentes</a>
          </li>
          <li class="nav-item active font-weight-bold">
              <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>


<form class="" action="" method="post">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
          <form class="form" method="" action="">
            <div class="card card-login card-hidden">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Bienvenido!</h4>

              </div>
              <div class="card-body ">
                <p class="card-description text-center">Logeate</p>
                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">email</i>
                      </span>
                    </div>
                    <input type="text" class="form-control" name="username" value="" placeholder="Nombre...">
                  </div>
                </span>

                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock</i>
                      </span>
                    </div>
                    <input type="password" class="form-control" name="password" value=""  placeholder="Contraseña...">
                  </div>
                </span>
                </div>
              <div class="footer text-center">
                <input type="submit"  class="btn btn-rose btn-link btn-lg" name='submit' value='Login'></input>

              </div>
              <div class="text-center text-muted pb-3"><a href="register.html" class="text-reset"> ¿No estas registrado? Crea tu cuenta acá.</a>
              </div>
            </div>
          </form>
        </div>

    </div>
 </div>
</form>


   </body>
 </html>
