<?php
$medicinas = $this->d['medicinas'];
$sucursals = $this->d['sucursals'];

?>
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
        <h1 class="center">Registro de Medicinas por sucursal</h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>consulta/registrarmedicinassucursal" method="POST">

        

            <p>
                <label for="codMedicina">Codigo de las medicinas</label>
                <select style="width:125px" name="codMedicina" class="custom-select">
                    <option value="">Seleccione</option>
                    <?php

                    foreach ($medicinas as $medicina) {
                        echo "<option value=$medicina >" . $medicina . "</option>";
                    }
                    ?>
                </select>

            </p>
            <p>
                <label for="codSucursal">Codigo de la Sucursal</label>
                <select style="width:125px" name="codSucursal" class="custom-select">
                    <option value="">Seleccione</option>
                    <?php

                    foreach ($sucursals as $sucursal) {
                        echo "<option value=$sucursal >" . $sucursal . "</option>";
                    }
                    ?>
                </select>

            </p>
            <p>
                <label for="cantidad">Cantidad</label><br>
                <input type="text" name="cantidad"   required>
            </p>
            

            <p>
            <input type="submit" value="Registrar">
            </p>

        </form>
    </div>

  
</body>
</html>