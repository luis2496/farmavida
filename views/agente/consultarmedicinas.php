<?php
$user = $this->d['user'];
$medicinas = $this->d['medicinas'];
?>
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
  <h1>AGENTE
    <?php echo $user->getCod() ?>
  </h1>
  <center>
    <h3>Ingresar cantidad de medicinas</h3>
  </center>

  <div class="container">
    <caption>Medicinas</caption>
    <form action="" method="post">

      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Código de la medicina</th>
                <th>Codigo de la sucursal</th>

                <th>Cantidad</th>


              </tr>
            </thead>
            <tbody>
              <?php

              // Recorrer los resultados y agregarlos a la tabla
              //$options = $medicinas;
              
              foreach ($medicinas as $medicina) {
                // $medicinass = new SucursalMedicinaModel();
                //  $medicinass = $row;
              
             //   echo "<option value=$row >" . $row . "</option>";




                ?>

                <tr >
                  <td >
                  <?php echo $medicina['medicina']->getcodmedicina() ?>
                  </td>
                  <td >
                  <?php echo $medicina['medicina']->getcodigosucursal() ?>
                  </td>
                  <td >
                  <?php echo $medicina['medicina']->getcantidad() ?>
                  </td>
                  <td><a
                      href="<?php echo constant('URL') . 'sucursalmedicina/verMedicina/' . $medicina['medicina']->getcodmedicina(); ?>">Agregar</a>
                  </td>

                </tr>

              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
  </div>


</body>

</html>