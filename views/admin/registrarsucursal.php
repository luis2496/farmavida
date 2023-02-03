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
        <h1 class="center">Registrar Sucursal </h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>sucursals/registrar" method="POST">

            <p>
                <label for="codSucursal">Codigo de Sucursal</label><br>
                <input type="text" name="codSucursal"   required>
            </p>
            <p>
                <label for="estado">Estado</label><br>
                <input type="text" name="estado"   required>
            </p>
            <p>
                <label for="ciudad">Ciudad</label><br>
                <input type="text" name="ciudad"  required>
            </p>
            <p>
                <label for="direccion">Direccion</label><br>
                <input type="text" name="direccion"  required>
            </p>

            <p>
            <input type="submit" value="Registrar">
            </p>

        </form>
    </div>

  
</body>
</html>