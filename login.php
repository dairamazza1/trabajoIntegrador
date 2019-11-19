<?php

include_once("soporte.php");
//SESIÓN
if ($auth->estaLogueado()) {
  header("Location:inicio.php");exit;
}

$errores = [];
if(isset($_POST["submit"]))  {
  $errores = $validator->validarLogin($_POST,$db); //TRAE LOS ERRORES
  if (count($errores) == 0) {
    // LOGUEAR
        $auth->loguear($_POST["email"]);
    if (isset($_POST["recordame"])) {
      //Quiere que lo recuerde
      $auth->recordame($_POST["email"]);
    }
        header("Location:index.php");
  }
}

///////////////////JSON
/*
$username="";
$password="";

$usuarioVacioError = false;
$contraseniaVaciaError= false;

$script=basename(__FILE__);

//ARRAY DE USUARIOS GUARDADOS
$usuarios = [];

if(isset($_POST["submit"])) 
{
  if (empty($_POST["username"])){
    $usuarioVacioError = true;
  } else {
    $username=$_POST["username"];
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


//ANALIZA EL CONTENIDO DEL REGISTER

  $archivo='usuarios.json';
  if(file_exists($archivo))
  {
    $usuariosJson=file_get_contents($archivo);
    $usuarios= json_decode($usuariosJson,true);
    $usuarioExiste=false; //declaro que es falso y si existe se convierte en verdadero
    

    foreach ($usuarios as $usuario) //recorre el array con todos los usuarios
    {
      if($usuario['username']==$username) //el nombre del usuario es igual al que paso en el formulario?.. Sino lo es, tiene que pasar al siguinte usuario
      { 
        $usuarioExiste=true;
        $contraseniaEncriptada=md5($password);//si el usuario existe hay que encriptar la contraseña

        if($usuarioExiste && $usuario['password']==$contraseniaEncriptada) //Si el usuario existe y la contraseña coincide 
        {  
          // LOGUEAR
          $_SESSION["logueado"] = $_POST["usuario"];
          if (isset($_POST["recordame"])) {  //checkbox
            //Quiere que lo recuerde
            setcookie("logueado", $_POST["usuario"], time() + 3600 * 2);
          }
          header("Location:index.php");
        }
    }
    }
    /*
    if(!$usuarioExiste){  //si el usuario no existe...
      $usuarioNoExisteError=true;
    }
 }
}
*/

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
     
   <?php include 'nav/layout.php'; ?>

   <section>
   <div class="page-header header-filter">
     <div class="container log"  style="margin-top: 25vh;">
         <div class="row">
           <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
               <form class="form" method="post" action="">
                 <div class="card card-login card-hidden">
                   <div class="card-header card-header-primary text-center">
                     <h4 class="card-title">Bienvenido</h4>
                     <!--<a class="brand"><img src="image/tipografia.png" alt="brand" height="45" width="150"></a> -->
                   </div>
                   <div class="card-body">
                     <p class="card-description text-center">  </p>

                     <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">email</i>
                        </span>
                      </div>
                      <input type="email" class="form-control" name="email" value='' placeholder="Correo electronico..."> <!-- ¿Se puede? Persistencia. value='<?//= $emailDefault?>' -->
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
                         <input type="password" class="form-control" name="password" value=""  placeholder="Contraseña..." maxlength="15">
                       </div>
                     </span>

                     
                    </div>
                   <div class="card-footer justify-content-center text-center">
                     <input type="submit"  class="btn btn-rose btn-link btn-lg" name='submit' value='Ingresa'>

                   </div>

                    <div class="card-footer justify-content-center text-center">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox">
                      <label class="form-check-label text-muted" for="recordarme">Recordarme</label>
                    </div>
                     

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
