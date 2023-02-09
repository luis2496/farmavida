<?php
class SucursalMedicina extends SessionController
{
    private $user;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
        $this->view->medicinas = [];
    }

    function render()
    { 
        
        //$medicina = $this->model->get();
        //$this->view->medicinas = $medicina;
        
        $this->view->render('agente/consultarmedicinas', [
            'user'                 => $this->user,
            'medicinas' => $this->getListSucursal()
        ]);
    }


    private function getListSucursal(){
        $res = [];
        $sucursalmedicinamodel = new SucursalMedicinaModel();
        $medicinas = $sucursalmedicinamodel->getAll($this->user->getCod());

        foreach ($medicinas as $medicina) {
          //  array_push($res, $medicina->getcodmedicina());
          $sucursalArray = [];
          $sucursalArray['medicina'] = $medicina;
         
          array_push($res, $sucursalArray);

        }
      //  $res = array_values(array_unique($res));

        return $res;
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
        $cantidad2 = $_POST['cantidad2'];
        $cantidadtotal = $cantidad + $cantidad2;

        if ($this->model->update(['codMedicina' => $codigomedicina, 'codSucursal' => $codigosucursal,'cantidad' => $cantidadtotal])) {
           
            $medicinas = new Medicinas();
            $medicinas->codigomedicina = $codigomedicina;
            $medicinas->codigosucursal = $codigosucursal;
            $medicinas->cantidad = $cantidad;
           
          
            $this->view->medicinas = $medicinas;
         
         

            $this->model->actualizarinventario(['codMedicina' => $codigomedicina,'cantidad' => $cantidad2]);
           

          

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