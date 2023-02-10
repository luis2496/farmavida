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
        <h1 class="center">Detalle de <?php echo $this->medicinas->codMedicina ?></h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>listamedicina/actualizar" method="POST">

            <p>
                <label for="codSucursal">Codigo de la Sucursal</label><br>
                <input type="text" name="codSucursal" value="<?php echo $this->medicinas->codigosucursal ?>"  required>
            </p>
            <p>
                <label for="codSucursal">Estado</label><br>
                <input type="text" name="codSucursal"   required>
            </p>
            <p>
                <label for="nombre">Ciudad</label><br>
                <input type="text" name="nombre"  required>
            </p>
            <p>
                <label for="cantidad">Direccion</label><br>
                <input type="text" name="cantidad"  required>
            </p>

            <p>
            <input type="submit" value="Actualizar">
            </p>

        </form>
    </div>

  
</body>
</html>