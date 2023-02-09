
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
                <label for="nombre">Nombre</label><br>
                <input type="text" name="nombre"  value="<?php echo $this->medicina->nombre ?>" required>
            </p>
           

            <p>
            <input type="submit" value="Actualizar">
            </p>

        </form>
    </div>

  
</body>
</html>