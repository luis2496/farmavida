<?php
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Registro de Medicinas</title>
    </head>
    <body><?php include('panel.php');?>
        <div class="container">
        <caption>Registro de medicinas.</caption>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body">
                        <form action="" method="">
                        <div class="form-group">
                            <input type="text" name="formula" class="form-control" placeholder="Formula" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="presentacion" class="form-control" placeholder="Presentación" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="cantidadUnidades" class="form-control" placeholder="Cantidad/Unidades" required>
                        </div>
                   
                        <input type="submit" name="submit" value="Guardar" class="btn btn-success btn-block">
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </body>
</html>