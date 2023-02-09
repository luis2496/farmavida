<?php

class Consulta extends SessionController{

    private $user;
   
   
    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
      
        $this->view->medicina = [];
    }

    function render()
    {    
      
        //$medicinas = $this->model->get();
        $medicinas = $this->model->get();
       $this->view->medicina = $medicinas;
        $this->view->render('admin/consulta',[
            'user' => $this->user,
            'medicinas' => $this->getListMedicinas(),
           'sucursals' => $this->getListSucursal()
           //'medicinas' => $this->getListMedicinas()
        ]);
    }



    
    function pantallaregistroporSucursal()
    {
        $this->view->mensaje = "";
        $this->view->render('admin/registrarporsucursal',[
            'user' => $this->user,
            'medicinas' => $this->getListMedicinas(),
           'sucursals' => $this->getListSucursal()
           //'medicinas' => $this->getListMedicinas()
        ]);
    }
    function registrarmedicinassucursal(){
      
        $codigo = $_POST['codMedicina'];
        $codSucursal = $_POST['codSucursal'];
        $cantidad    = $_POST['cantidad'];
      
       

        if($this->model->registrarmedicinassucursal(['codMedicina' => $codigo,'codSucursal' => $codSucursal ,'cantidad' => $cantidad])){

           // $this->model->actualizarinventario(['codMedicina' => $codigo,'cantidad' => $cantidad]);
           $this->model->Sumarinventario(['codMedicina' => $codigo,'cantidad' => $cantidad]);
           
           $this->view->mensaje = "Medicina Registrada correctamente";
         
            $this->view->render('admin/registrarporsucursal',[
               
                'medicinas' => $this->getListMedicinas(),
               'sucursals' => $this->getListSucursal()
               //'medicinas' => $this->getListMedicinas()
            ]);
        }else
        
        {
            $this->view->mensaje = "La Medicina ya está registrada";
            $this->view->render('admin/registrarporsucursal',[
               
                'medicinas' => $this->getListMedicinas(),
               'sucursals' => $this->getListSucursal()
               //'medicinas' => $this->getListMedicinas()
            ]);
        }
    }

    private function getListMedicinas(){
        $res = [];
        $listamedicinasucursal = new ConsultaModel();
        $medicinas = $listamedicinasucursal->getAllMedicina();

        foreach ($medicinas as $medicina) {
            array_push($res, $medicina->getcodMedicina());
        }
        $res = array_values(array_unique($res));

        return $res;
    }

    private function getLista(){
        $res = [];
       
        $medicinamodel = new ConsultaModel();
        $medicinas = $medicinamodel->gettotal($this->$medicinamodel->getcodMedicina());

        foreach ($medicinas as $medicina) {
            array_push($res, $medicina->getcodMedicina());
        }
        $res = array_values(array_unique($res));

        return $res;
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
    private function getListMedicinaporSucursal(){
        $res = [];
       
        $listamedicinasucursal = new ListaMedicinaModel();
        $codigo = $listamedicinasucursal->getcodMedicina();
        
        $sucursals = $listamedicinasucursal->getAllSucursalMedicina($codigo);

        foreach ($sucursals as $sucursal) {
            array_push($res, $sucursal->getcodigosucursal());
        }
        $res = array_values(array_unique($res));

        return $res;
    }


    function pantallaregistro()
    {
        $this->view->mensaje = "";
        $this->view->render('admin/registrarmedicina');
    }
    function registrar(){
      
        $codigo = $_POST['codMedicina'];
        $nombre    = $_POST['nombre'];
       // $cantidad  = $_POST['cantidad'];
       

        if($this->model->insert(['codMedicina' => $codigo, 'nombre' => $nombre,'cantidad' => 0])){
            
           
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
       // $cantidad  = $_POST['cantidad'];
       

        if($this->model->update(['codMedicina' => $codigo,'nombre' => $nombre] )){
            // actualizar alumno exito
            $medicina = new Medicina();
            $medicina->codigo = $codigo;
            $medicina->nombre = $nombre;
           // $medicina->cantidad = $cantidad;
  
            
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
            $this->model->deletesucursal($codMedicina);
            
            $mensaje = "Medicina eliminada correctamente";
        }else{
            
            $mensaje = "No se pudo eliminar la Medicina";
        }
       $this->render();
        
        echo $mensaje;
    }


    
}

?>