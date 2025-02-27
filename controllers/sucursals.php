<?php

class Sucursals extends SessionController
{    private $user;

    function __construct()
    {
        parent::__construct();
                $this->user = $this->getUserSessionData();

        $this->view->sucursal = [];
    }

    function render()
    {
        $sucursals = $this->model->get();
        $this->view->sucursal = $sucursals;
        $this->view->render('admin/consultasucursal', [
            'user'                 => $this->user
           
        ]);;
    }
    function verlistaMedicinas($param = null)
    {
       
        $this->view->render('admin/listamedicinas');
    }

    private function getListmedicinas($codsucursal){
        $res = [];
       
        $sucursalmodel = new SucursalsModel();
        $medicinas = $sucursalmodel->getAlls($codsucursal);

        foreach ($medicinas as $medicina) {
          //  array_push($res, $medicina->getcodmedicina());
          $sucursalArray = [];
          $sucursalArray['medicina'] = $medicina;
         
          array_push($res, $sucursalArray);

        }
      //  $res = array_values(array_unique($res));

        return $res;
    }

    function pantallaregistro()
    {
        $this->view->mensaje = "";
        $this->view->render('admin/registrarsucursal');
    }
    function registrar(){
      
        $codSucursal = $_POST['codSucursal'];
        $estado    = $_POST['estado'];
        $ciudad  = $_POST['ciudad'];
        $direccion  = $_POST['direccion'];

        if($this->model->insert(['codSucursal' => $codSucursal, 'estado' => $estado, 'ciudad' => $ciudad,'direccion' => $direccion])){
            
           
            $this->view->mensaje = "Sucursal Registrada correctamente";
         
            $this->view->render('admin/registrarsucursal');
        }else
        
        {
            $this->view->mensaje = "La Sucursal ya está registrada";
            $this->view->render('admin/registrarsucursal');
        }
    }
    //MUESTRA EN OTRA VENTANA LOS DATOS DE LA MEDICINA SELECCIONADA
    function verSucursal($param = null)
    {
        // var_dump($param);
        $codSucursal = $param[0];
        $sucursal = $this->model->getById($codSucursal);

       
        $this->view->sucursal = $sucursal;
        $this->view->mensaje = "";
        $this->view->render('admin/actualizarsucursal');
    }

    function actualizarSucursal()
    { 
      $codSucursal = $_POST['codSucursal'];
        $estado    = $_POST['estado'];
        $ciudad  = $_POST['ciudad'];
        $direccion  = $_POST['direccion'];
       

        if($this->model->update(['codSucursal' => $codSucursal,'estado' => $estado,'ciudad' => $ciudad,'direccion' => $direccion] )){
            // actualizar alumno exito
            $sucursal = new Sucursal();
            $sucursal->codSucursal = $codSucursal;
            $sucursal->estado = $estado;
            $sucursal->ciudad = $ciudad;
            $sucursal->direccion = $direccion;
  
            
            $this->view->sucursal = $sucursal;
           
            $this->view->mensaje = "Datos actualizados correctamente";
     
            $this->view->render('admin/actualizarsucursal');
            
        }
        
        else
        {
            $this->view->mensaje = "No se pudo actualizar ";
           
        }
      
       
       
    }
    function eliminar($param = null)
        {
            $codSucursal = $param[0];
    
            if($this->model->delete($codSucursal)){
               
                $mensaje = "Sucursal eliminada correctamente";
            }else{
                
                $mensaje = "No se pudo eliminar la Sucursal";
            }
           $this->render();
            
            echo $mensaje;
        } 


    
}

?>