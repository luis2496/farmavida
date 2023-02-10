
<?php

class ListaMedicina extends SessionController{


    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
      
    }

     function render(){
       

        $this->view->render('admin/listamedicinas', [
            'user' => $this->user,
           'sucursals' => $this->getListSucursal(),
           //'medicinas' => $this->getListMedicinas()
        ]);
    }


    private function getListSucursal(){
        $res = [];
        $listamedicinasucursal = new ListaMedicinaModel();
        $sucursals = $listamedicinasucursal->getAllSucursal();

        foreach ($sucursals as $sucursal) {
            array_push($res, $sucursal->getcodigosucursal());
        }
        $res = array_values(array_unique($res));

        return $res;
    }
    private function getListMedicinas(){
        $res = [];
        $listamedicinamodel = new ListaMedicinaModel();
        $medicinas = $listamedicinamodel->getAll_lista();

        foreach ($medicinas as $medicina) {
          //  array_push($res, $medicina->getcodmedicina());
          $sucursalArray = [];
          $sucursalArray['medicina'] = $medicina;
         
          array_push($res, $sucursalArray);

        }
      //  $res = array_values(array_unique($res));

        return $res;
    }
    function verMedicina($param = null)
    {   
        

        // var_dump($param);
        $codmedicina = $param[0];
      
       // $codsucu = $this->user->getcodsucursal();
        $medicinas = $this->model->getById($codmedicina);


        $this->view->medicinas = $medicinas;
        $this->view->mensaje = "";
        $this->view->render('admin/actualizarmedicinasucursal');
    }

    function actualizar()
    {
        $codMedicina = $_POST['codMedicina'];
        $codigosucursal = $_POST['codSucursal'];
        $nombre    = $_POST['nombre'];
        $cantidad  = $_POST['cantidad'];
       

        if($this->model->update(['codMedicina' => $codMedicina,'codSucursal' => $codigosucursal,'nombre' => $nombre,'cantidad' => $cantidad] )){
            // actualizar alumno exito
            $medicina = new Lista();
            $medicina->codMedicina = $codMedicina;
            $medicina->codigosucursal = $codigosucursal;
            $medicina->nombre = $nombre;
            $medicina->cantidad = $cantidad;
          
            
            $this->view->medicina = $medicina;
           
            $this->view->mensaje = "Medicina actualizada correctamente";

            $this->view->render('admin/actualizarmedicinasucursal');
        }
        
        else
        {
            $this->view->mensaje = "No se pudo actualizar ";
           
        }
      
    }


   
    // devuelve el JSON para las llamadas AJAX
    function getHistoryJSON(){
        header('Content-Type: application/json');
        $res = [];
        $listamedicinamodel = new ListaMedicinaModel();
        $medicinas = $listamedicinamodel->getAll_lista();

        foreach ($medicinas as $medicina) 
        {
            
            array_push($res, $medicina->toArray());
            
        }
        
        echo json_encode($res);

    }
    function getExpensesJSON(){
        header('Content-Type: application/json');

        $res = [];
       
        $listasucursal  = $this->getListSucursal();
        

        array_unshift($listasucursal, 'mes');
       
        /* array_unshift($categoryNames, 'categorias');
        array_unshift($categoryColors, NULL); */


        array_unshift($res, $listasucursal);
      
        
        echo json_encode($res);
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