
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php include('panel.php');?>

    <div id="main">
        <h1 class="center">Detalle de <?php echo $this->agentes->codusuario ?></h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>usuario/actualizar" method="POST">

           <p>
            <label for="codusuario">Codigo de Usuario</label><br>
                <input type="text" name="codusuario" value="<?php echo $this->agentes->codusuario ?>" required>
            </p>


            <p>
                <label for="codsucu">Codigo de la Sucursal</label><br>
                <input type="text" name="codsucu" value="<?php echo $this->agentes->codsucursal ?>" required>
            </p>
            <p>
                <label for="username">Nombre de usuario</label><br>
                <input type="text" name="username"  value="<?php echo $this->agentes->username ?>" required>
            </p>
            <p>
                <label for="password">Contrasenna</label><br>
                <input type="text" name="password" value="<?php echo $this->agentes->password ?>" required>
            </p>
            <p>
                <label for="role">rol</label><br>
                <input type="text" name="role" value="<?php echo $this->agentes->role ?>" required>
            </p>
            <p>
                <label for="nombres">Nombres y Apellidos</label><br>
                <input type="text" name="nombres" value="<?php echo $this->agentes->nombres ?>" required>
            </p>
        

            <p>
            <input type="submit" value="Actualizar">
            </p>

        </form>
    </div>

  
</body>
</html>