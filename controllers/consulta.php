<?php

class Consulta2 extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view->medicina = [];
    }

    function render()
    {
        $medicinas = $this->model->get();
        $this->view->medicina = $medicinas;
        $this->view->render('agente/consulta');
    }

    //MUESTRA EN OTRA VENTANA LOS DATOS DE LA MEDICINA SELECCIONADA
    function verMedicina($param = null)
    {
        // var_dump($param);
        $codMedicina = $param[0];
        $medicina = $this->model->getById($codMedicina);

       
        $this->view->medicina = $medicina;
        $this->view->mensaje = "";
        $this->view->render('agente/detalle');
    }

    function actualizarMedicina()
    { 
      $codigo = $_POST['codMedicina'];
        $formula    = $_POST['formula'];
        $cantidad  = $_POST['cantidadUnidades'];
       

        if($this->model->update(['codMedicina' => $codigo,'cantidadUnidades' => $cantidad] )){
            // actualizar alumno exito
            $medicina = new Medicina();
            $medicina->codigo = $codigo;
            $medicina->formula = $formula;
            $medicina->cantidad = $cantidad;
  
            
            $this->view->medicina = $medicina;
           
            $this->view->mensaje = "Cantidad actualizada correctamente";
     
            $this->view->render('agente/detalle');
        }
        
        else
        {
            $this->view->mensaje = "No se pudo actualizar ";
           
        }
      
       
       
    }


    
}

?>