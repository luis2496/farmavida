<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/login.css">
    <STYLE TYPE="text/css" MEDIA=screen>
    /* Aquí se escribe el CSS */
<!--  
  BODY  { background-image: url("views/images/fondo2.png");
          color:#FFFFFF;
          background-size: cover;
         color: green; 
         font-family: arial black,helvetica;
         border-color: green ;
         border-style: solid;
       
     }

  h2 {border-width: 2px; border: solid; text-align: center; color:green}
 
-->
</STYLE>  
    
    <style>
    .center-img {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
</head>
<body>

<div class="center-img">
    <img src="views/images/Logo.jpg" width="270" height="135">
</div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <?php $this->showMessages();?>
                <div id="login-main">
                    <form action="<?php echo constant('URL'); ?>logins/authenticate" method="POST">
                        <div class="text-danger"><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>
                        <h2 class="text-center mb-4">Bienvenidos </h2>
                        <div class="center-img">
                        <img src="views\images\7.png" alt="70" width="170"/>
                        </div>
                        <h3 class="text-center mb-4">Iniciar sesión</h3>

                        <div class="form-group">
                            <label for="username">Usuario</label>
                            <input type="text" class="form-control" name="username" id="username" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Iniciar sesión" class="btn btn-primary btn-block"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
