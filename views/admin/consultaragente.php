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
    <h3>Lista de Agentes</h3>
  </center>

  <div class="container">
    <caption>Medicinas</caption>
    <form action="" method="post">

      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Código de Usuario</th>
                <th>Codigo de la sucursal</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>direccion</th>
                <th>telefono</th>
              


              </tr>
            </thead>
            <tbody>
              <?php
              include_once 'models/agente.php';
              // Recorrer los resultados y agregarlos a la tabla
              
              foreach ($this->agente as $row) {
                $agentes = new Agente();
                $agentes = $row;



                ?>

                <tr>
                  <td>
                    <?php echo $agentes->codusuario ?>
                  </td>
                  <td>
                    <?php echo $agentes->codsucursal ?>
                  </td>
                  <td>
                    <?php echo $agentes->cedula ?>
                  </td>
                  <td>
                    <?php echo $agentes->nombre ?>
                  </td>
                  <td>
                    <?php echo $agentes->apellido ?>
                  </td>
                  <td>
                    <?php echo $agentes->direccion ?>
                  </td>
                  <td>
                    <?php echo $agentes->telefono ?>
                  </td>
                  <td><a href="<?php echo constant('URL') . 'agentes/verAgente/' . $agentes->codusuario; ?>">Agregar</a></td>
                  <td><a href="<?php echo constant('URL') . 'agentes/eliminar/' . $agentes->codusuario; ?>">Eliminar</a></td>
                </tr>

              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
  </div>

</body>

</html>