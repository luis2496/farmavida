<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>
  <?php include('panel.php'); ?>
  <center>
    <h3>Lista Sucursales</h3>
  </center>

  <div class="container">
   
    <form action="" method="post">

      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Código de la Sucursal</th>
                <th>Estado</th>
                <th>Ciudad</th>
                <th>Direccion</th>


              </tr>
            </thead>
            <tbody>


              <?php
              include_once 'models/sucursal.php';
              // Recorrer los resultados y agregarlos a la tabla
              
              foreach ($this->sucursal as $row) {
                $sucursals = new Sucursal();
                $sucursals = $row;

                ?>

                <tr>
                  <td>
                    <?php echo $sucursals->codSucursal ?>
                  </td>
                  <td>
                    <?php echo $sucursals->estado ?>
                  </td>
                  <td>
                    <?php echo $sucursals->ciudad ?>
                  </td>
                  <td>
                    <?php echo $sucursals->direccion ?>
                  </td>
                  <td><a href="<?php echo constant('URL') . 'sucursals/verSucursal/' . $sucursals->codSucursal; ?>">Actualizar</a></td>
                  <td><a href="<?php echo constant('URL') . 'sucursals/eliminar/' . $sucursals->codSucursal; ?>">Eliminar</a></td>
                </tr>
               


              <?php } ?>

              <button type="button" class="btn btn-success">Registrar</button>
              <a href="<?php echo constant('URL') .'sucursals/registrar/' ; ?>">Registrar</a>




            </tbody>
          </table>
        </div>
      </div>
  </div>

</body>

</html>