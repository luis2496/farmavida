<?php
// Conexión a la base de datos
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'farmavida';

$conn = mysqli_connect($host, $username, $password, $dbname);

// Verificar conexión
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Consulta para obtener los datos de la tabla
$sql = "SELECT * FROM sucursal";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  </head>
  <body> <?php include('panel.php');?>
    <div class="container">
    <caption>Sucursales</caption>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Código de la sucursal</th>
            <th>Estado</th>
            <th>Ciudad</th>
            <th>Dirección</th>
            <th>Estatus</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // Recorrer los resultados y agregarlos a la tabla
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['codSucursal'] . '</td>';
                    echo '<td>' . $row['estado'] . '</td>';
                    echo '<td>' . $row['ciudad'] . '</td>';
                    echo '<td>' . $row['direccion'] . '</td>';
                    echo '<td>' . $row['estatus'] . '</td>';
                    echo '<a href="registrarsucursal.php" class="btn btn-success btn-sm">Agregar</a>';
                    echo '</tr>';
                }
            } else {
                echo "No se encontraron resultados";
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>

<?php
// Cerrar conexión
mysqli_close($conn);
?>