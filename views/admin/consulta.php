
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
    <h3>Lista de Medicinas</h3>
  </center>

  <div class="container">
 
    <form action="" method="post">

      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr align="center">
                <th>Código de la medicina</th>
                <th>Nombre</th>

                <th>Cantidad Total por Medicina</th>


              </tr>
            </thead>
            <tbody>
              <?php
              include_once 'models/medicina.php';
              // Recorrer los resultados y agregarlos a la tabla
              
              foreach ($this->medicina as $row) {
                $medicinas = new Medicina();
                $medicinas = $row;



                ?>

                <tr align="center">
                  <td>
                    <?php echo $medicinas->codigo ?>
                  </td>
                  <td>
                    <?php echo $medicinas->nombre ?>
                  </td>
                  <td >
                    <?php echo $medicinas->cantidad ?>
                  </td>
                  <td><a href="<?php echo constant('URL') . 'consulta/verMedicina/' . $medicinas->codigo; ?>">Actualizar</a></td>
                  <td><a href="<?php echo constant('URL') . 'consulta/eliminar/' . $medicinas->codigo; ?>">Eliminar</a></td>
                </tr>
                
                
              <?php } ?>

              <a href="<?php echo constant('URL') .'consulta/pantallaregistro/' ; ?>"> Registrar </a>
              <a href="<?php echo constant('URL') .'consulta/pantallaregistroporSucursal/' ; ?>"> Registrar </a>

            </tbody>
          </table>
        </div>
      </div>
  </div>

</body>

</html>