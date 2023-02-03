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
        <h1 class="center">Detalle de <?php echo $this->sucursal->codSucursal ?></h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>sucursals/actualizarSucursal" method="POST">

            <p>
                <label for="codSucursal">Codigo de Medicina</label><br>
                <input type="text" name="codSucursal"  value="<?php echo $this->sucursal->codSucursal ?>" required>
            </p>
            <p>
                <label for="estado">Formula</label><br>
                <input type="text" name="estado"  value="<?php echo $this->sucursal->estado ?>" required>
            </p>
            <p>
                <label for="ciudad">Cantidad</label><br>
                <input type="text" name="ciudad" value="<?php echo $this->sucursal->ciudad ?>" required>
            </p>
            <p>
                <label for="direccion">Cantidad</label><br>
                <input type="text" name="direccion" value="<?php echo $this->sucursal->direccion ?>" required>
            </p>

            <p>
            <input type="submit" value="Actualizar">
            </p>

        </form>
    </div>

  
</body>
</html>