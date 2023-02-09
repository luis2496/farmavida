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
        <h1 class="center">Detalle de <?php echo $this->medicinas->codigomedicina ?></h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>sucursalmedicina/actualizarMedicina" method="POST">

            <p>
                <label for="codMedicina">Codigo de Medicina</label><br>
                <input type="text" name="codMedicina"  value="<?php echo $this->medicinas->codigomedicina ?>" required>
            </p>
            <p>
                <label for="codSucursal">Codigo Sucursal</label><br>
                <input type="text" name="codSucursal"  value="<?php echo $this->medicinas->codigosucursal ?>" required>
            </p>
            
            <p>
                <label for="cantidad">Cantidad</label><br>
                <input type="text" name="cantidad" value="<?php echo $this->medicinas->cantidad ?>" required>
            </p>
            <p>
                <label for="cantidad2">Cantidad a agregar</label><br>
                <input type="text" name="cantidad2"  required>
            </p>

            <p>
            <input type="submit" value="Actualizar">
            </p>

        </form>
    </div>

  
</body>
</html>