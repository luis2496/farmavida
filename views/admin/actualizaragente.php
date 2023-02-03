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

        <form action="<?php echo constant('URL'); ?>agentes/actualizarAgente" method="POST">

           <p>
            <label for="codusuario">Codigo de Usuario</label><br>
                <input type="text" name="codusuario"  value="<?php echo $this->agentes->codusuario ?>" required>
            </p>
            <p>
                <label for="codsucursal">Codigo de la Sucursal</label><br>
                <input type="text" name="codsucursal"  value="<?php echo $this->agentes->codsucursal ?>" required>
            </p>
            <p>
                <label for="cedula">Cedula</label><br>
                <input type="text" name="cedula"  value="<?php echo $this->agentes->cedula ?>" required>
            </p>
            <p>
                <label for="nombre">Nombre</label><br>
                <input type="text" name="nombre" value="<?php echo $this->agentes->nombre ?>" required>
            </p>
            <p>
                <label for="apellido">Apellido</label><br>
                <input type="text" name="apellido" value="<?php echo $this->agentes->apellido ?>" required>
            </p>
            <p>
                <label for="direccion">Direccion</label><br>
                <input type="text" name="direccion" value="<?php echo $this->agentes->direccion ?>" required>
            </p>
            <p>
                <label for="telefono">Telefono</label><br>
                <input type="text" name="telefono" value="<?php echo $this->agentes->telefono ?>" required>
            </p>

            <p>
            <input type="submit" value="Actualizar">
            </p>

        </form>
    </div>

  
</body>
</html>