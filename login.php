<?php

$username="asdasd";
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
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One|Nixie+One|Suranna&display=swap" rel="stylesheet">
     <title>Mi proyecto</title>
   </head>

   <body>
      <header>
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
              <a class="nav-link" href="login.php">Tu cuenta<span class="sr-only">(current)</span></a></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Registro</a>
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
               <form class="form" method="" action="">
                 <div class="card card-login card-hidden">
                   <div class="card-header card-header-primary text-center">
                     <h4 class="card-title">Bienvenido</h4>
                     <!--<a class="brand"><img src="image/tipografia.png" alt="brand" height="45" width="150"></a> -->
                   </div>
                   <div class="card-body">
                     <p class="card-description text-center">    </p>
                     <span class="bmd-form-group">
                       <div class="input-group">
                         <div class="input-group-prepend">
                           <span class="input-group-text">
                             <i class="material-icons">email</i>
                           </span>
                         </div>
                         <input type="text" class="form-control" name="username" value="" placeholder="E-mail...">
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
                   <div class="card-footer justify-content-center text-center">
                     <input type="submit"  class="btn btn-rose btn-link btn-lg" name='submit' value='Ingresa'></input>

                   </div>
                   <div class="text-center text-muted pb-3"><a href="register.php" class="text-reset"> ¿No estas registrado? Crea tu cuenta acá.</a>
                   </div>
                 </div>
               </form>
             </div>
         </div>
     </div>
   </div>
   </section>


   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

   </body>
 </html>
