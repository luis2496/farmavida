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
        <h1 class="center">Registrar Medicinas </h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>consulta/registrar" method="POST">

            <p>
                <label for="codMedicina">Codigo de la Medicina</label><br>
                <input type="text" name="codMedicina"   required>
            </p>
            <p>
                <label for="nombre">Nombre</label><br>
                <input type="text" name="nombre"   required>
            </p>
           

            <p>
            <input type="submit" value="Registrar">
            </p>

        </form>
    </div>

  
</body>
</html>