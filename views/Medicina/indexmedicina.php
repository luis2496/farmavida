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
$sql = "SELECT * FROM medicina";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
              table tr th {
              cursor: pointer;
              -webkit-user-select: none;
              -moz-user-select: none;
              -ms-user-select: none;
              user-select: none;
            }
            .sorting {background-color: #88E569;}
            .asc:after {content: ' ↑';}
            .desc:after {content: " ↓";}
    </style>  
  </head>
  <body><?php include('panel.php');?>
        <!-- Aquí va el menú -->

    <div class="container">
        <caption>Medicinas</caption><form action="" method="post">         

      <div class="panel panel-default">
      <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Código de la medicina</th>
            <th>Formula</th>
            <th>Presentación</th>
            <th>Cantidad/Unidades</th>
            <th>Estatus</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // Recorrer los resultados y agregarlos a la tabla
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['codMedicina'] . '</td>';
                    echo '<td>' . $row['formula'] . '</td>';
                    echo '<td>' . $row['presentacion'] . '</td>';
                    echo '<td>' . $row['cantidadUnidades'] . '</td>';
                    echo '<td>' . $row['estatus'] . '</td>';
                    echo '<td> <a href="' . $row['codMedicina'] . '" class="btn btn-warning btn-sm">Editar</a> ';
                    echo '<a href="' . $row['codMedicina'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'¿Está seguro de eliminar este registro?\')">Eliminar</a> </td>';
                    echo '</tr>';
                }
                echo '<a href="registrarmedicina.php" class="btn btn-success btn-sm">Agregar</a>';
            } else {
                echo "No se encontraron resultados";
            }
          ?>
        </tbody>
      </table>
      </div>
      </div>
    </div>
  </body>
</html>

<?php
// Cerrar conexión
mysqli_close($conn);
?>

<script>
$('th').click(function() {
    var table = $(this).parents('table').eq(0)
    var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
    this.asc = !this.asc
    if (!this.asc) {
      rows = rows.reverse()
    }
    for (var i = 0; i < rows.length; i++) {
      table.append(rows[i])
    }
    setIcon($(this), this.asc);
  })

  function comparer(index) {
    return function(a, b) {
      var valA = getCellValue(a, index),
        valB = getCellValue(b, index)
      return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
    }
  }

  function getCellValue(row, index) {
    return $(row).children('td').eq(index).html()
  }

  function setIcon(element, asc) {
    $("th").each(function(index) {
      $(this).removeClass("sorting");
      $(this).removeClass("asc");
      $(this).removeClass("desc");
    });
    element.addClass("sorting");
    if (asc) element.addClass("asc");
    else element.addClass("desc");
  }
</script>