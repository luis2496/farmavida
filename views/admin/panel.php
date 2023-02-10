<!DOCTYPE html>
<html lang="en">
<head>
  <title>Farmavida</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <STYLE TYPE="text/css" MEDIA=screen>
    /* Aquí se escribe el CSS */
<!--  
         
  BODY  {  background-image: url("views/images/1.1.png") ;
          background-size: cover;
         color: black; 
         font-family: arial black,helvetica;
         background-repeat: no-repeat;
        
     }
  
  nav{border-width: 2px; border: solid; text-align: center; color:green}
-->
</STYLE>

  
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }

  .center-img {
        display: flex;
        justify-content: center;
        align-items: center;
    }
  </style>
</head>
<body>
<div class="center-img">
    <img src="views\images\Logo.jpg" width="270" height="135">
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="<?php echo constant('URL');?>admin">FARMAVIDA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo constant('URL');?>admin">Inicio</a>
      </li>
      <li class="nav-item">
      <li class="nav-item">
      <a class="nav-link" href="<?php echo constant('URL'); ?>consulta">Medicinas</a>
      </li>
      
      <a class="nav-link" href="<?php echo constant('URL'); ?>listamedicina">Lista de Medicinas</a>
      </li>
      
      <li class="nav-item">
      <a class="nav-link" href="<?php echo constant('URL'); ?>sucursals">Sucursales</a>
      
      </li>
      <li class="nav-item">
      <a class="nav-link" href="<?php echo constant('URL'); ?>usuario">Agentes</a>
   
      </li>
      <li class="nav-item">

      <a class="nav-link" href="<?php echo constant('URL'); ?>logout">Cerrar sesión</a>
     
      </li>    
    </ul>
  </div>  
</nav>

</body>
</html>