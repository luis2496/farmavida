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
        <h1 class="center">Detalle de <?php echo $this->medicina->codigo ?></h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>consulta/actualizarMedicina" method="POST">

            <p>
                <label for="codMedicina">Codigo de Medicina</label><br>
                <input type="text" name="codMedicina"  value="<?php echo $this->medicina->codigo ?>" required>
            </p>
            <p>
                <label for="formula">Formula</label><br>
                <input type="text" name="formula"  value="<?php echo $this->medicina->formula ?>" required>
            </p>
            <p>
                <label for="cantidadUnidades">Cantidad</label><br>
                <input type="text" name="cantidadUnidades" value="<?php echo $this->medicina->cantidad ?>" required>
            </p>

            <p>
            <input type="submit" value="Actualizar">
            </p>

        </form>
    </div>

  
</body>
</html>