<?php

class Consulta extends Controller
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
        $this->view->render('admin/consulta');
    }
    function pantallaregistro()
    {
        $this->view->mensaje = "";
        $this->view->render('admin/registrarmedicina');
    }
    function registrar(){
      
        $codigo = $_POST['codMedicina'];
        $nombre    = $_POST['nombre'];
        $cantidad  = $_POST['cantidad'];
       

        if($this->model->insert(['codMedicina' => $codigo, 'nombre' => $nombre, 'cantidad' => $cantidad])){
            
           
            $this->view->mensaje = "Medicina Registrada correctamente";
         
            $this->view->render('admin/registrarmedicina');
        }else
        
        {
            $this->view->mensaje = "La Medicina ya está registrada";
            $this->view->render('admin/registrarmedicina');
        }
    }


    //MUESTRA EN OTRA VENTANA LOS DATOS DE LA MEDICINA SELECCIONADA
    function verMedicina($param = null)
    {
        // var_dump($param);
        $codMedicina = $param[0];
        $medicina = $this->model->getById($codMedicina);

       
        $this->view->medicina = $medicina;
        $this->view->mensaje = "";
        $this->view->render('admin/detalle');
    }

    function actualizarMedicina()
    { 
         $codigo = $_POST['codMedicina'];
        $nombre    = $_POST['nombre'];
        $cantidad  = $_POST['cantidad'];
       

        if($this->model->update(['codMedicina' => $codigo,'nombre' => $nombre,'cantidad' => $cantidad] )){
            // actualizar alumno exito
            $medicina = new Medicina();
            $medicina->codigo = $codigo;
            $medicina->nombre = $nombre;
            $medicina->cantidad = $cantidad;
  
            
            $this->view->medicina = $medicina;
           
            $this->view->mensaje = "Medicina actualizada correctamente";
     
            $this->view->render('admin/detalle');
        }
        
        else
        {
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