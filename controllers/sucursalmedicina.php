<?php

class SucursalMedicina extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view->medicinas = [];
    }

    function render()
    {
        $medicinass = $this->model->get();
        $this->view->medicinas = $medicinass;
        $this->view->render('agente/consultarmedicinas');
    }

    //MUESTRA EN OTRA VENTANA LOS DATOS DE LA MEDICINA SELECCIONADA
    function verMedicina($param = null)
    {
        // var_dump($param);
        $codmedicina = $param[0];
        $medicinas = $this->model->getById($codmedicina);


        $this->view->medicinas = $medicinas;
        $this->view->mensaje = "";
        $this->view->render('agente/registrarcantidad');
    }

    function actualizarMedicina()
    {
        $codigomedicina = $_POST['codMedicina'];
        $codigosucursal = $_POST['codSucursal'];
        $cantidad = $_POST['cantidad'];


        if ($this->model->update(['codMedicina' => $codigomedicina, 'cantidad' => $cantidad])) {
           
            $medicinas = new Medicinas();
            $medicinas->codigomedicina = $codigomedicina;
            $medicinas->codigosucursal = $codigosucursal;
            $medicinas->cantidad = $cantidad;


            $this->view->medicinas = $medicinas;

            $this->view->mensaje = "Cantidad actualizada correctamente";

            $this->view->render('agente/registrarcantidad');
        } else {
            $this->view->mensaje = "No se pudo actualizar ";

        }



    }


    function eliminar($param = null)
    {
        $codMedicina = $param[0];

        if($this->model->delete($codMedicina)){
           
            $mensaje = "Medicina eliminada correctamente";
        }else{
            
            $mensaje = "No se pudo eliminar la Medicina";
        }
       $this->render();
        
        echo $mensaje;
    }



}

?>