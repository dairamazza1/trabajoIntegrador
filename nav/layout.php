<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One|Nixie+One|Suranna&display=swap" rel="stylesheet">
</head>
<body>
<header>
        <!-- BARRA DE NAVEGACION -->
      <nav class="navbar navbar-expand-lg nav-down navbar-transparent" color-on-scroll="100" id="sectionsNav">
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
                    <a class="nav-link" href="index.php">Ingresá</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="pf.php">Preguntas Frecuentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $script == 'login.php'?'bold':''?>" href="login.php">Tu cuenta<span class="sr-only">(current)</span></a></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Registro</a>
                </li>
            
                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="dropdown_target" href="#">Perfil
                            <span class="caret"></span>
                        </a>
                        
                        <div class="dropdown-menu" aria-labelledby="dropdown_target">
                            <a class="dropdown-item" href="">Mi cuenta</a>
                            <a class="dropdown-item" href="">Salir</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item right">
                <a class="btn btn-round" href="#" target="_blank">
                <i class="material-icons">add_shopping_cart</i>
                </a>
                </li>
            </ul>
        </div>
        </div>
       </nav>
   </header>
</body>
</html>