<?php

class Agentes extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->view->agente = [];
    }

    function render()
    {

        $agente = $this->model->get();
        $this->view->agente = $agente;
        $this->view->render('admin/consultaragente');
    }
    function pantallaregistro()
    {
        $this->view->mensaje = "";
        $this->view->render('admin/registraragente');
    }
      
    function registrar(){
      
        $codusuario = $_POST['codusuario'];
        $codsucursal    = $_POST['codsucursal'];
        $cedula  = $_POST['cedula'];
        $nombre  = $_POST['nombre'];
        $apellido  = $_POST['apellido'];
        $direccion  = $_POST['direccion'];
        $telefono  = $_POST['telefono'];
       
       

        if($this->model->insert(['codusuario' => $codusuario, 'codsucursal' => $codsucursal, 'cedula' => $cedula,'nombre' => $nombre,'apellido' => $apellido,'direccion' => $direccion,'telefono' => $telefono])){
            
           
            $this->view->mensaje = "Agente Registrado correctamente";
         
            $this->view->render('admin/registraragente');
        }else
        
        {
            $this->view->mensaje = "el Agente ya está registrado";
            $this->view->render('admin/registraragente');
        }
    }

    //MUESTRA EN OTRA VENTANA LOS DATOS DE LO AGENTES SELECCIONADA
    function verAgente($param = null)
    {
        // var_dump($param);
        $codusuario = $param[0];
        $agentes = $this->model->getById($codusuario);


        $this->view->agentes = $agentes;
        $this->view->mensaje = "";
        $this->view->render('admin/actualizarAgente');
    }





    function actualizarAgente()
    {
        $codusuario = $_POST['codusuario'];
        $codsucursal = $_POST['codsucursal'];
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];


        if ($this->model->update(['codusuario' => $codusuario, 'codsucursal' => $codsucursal, 'cedula' => $cedula, 'nombre' => $nombre, 'apellido' => $apellido, 'direccion' => $direccion, 'telefono' => $telefono])) {
            // actualizar alumno exito
            $agentes = new Agente();
            $agentes->codusuario = $codusuario;
            $agentes->codsucursal = $codsucursal;
            $agentes->cedula = $cedula;
            $agentes->nombre = $nombre;
            $agentes->apellido = $apellido;
            $agentes->direccion = $direccion;
            $agentes->telefono = $telefono;


            $this->view->agentes = $agentes;

            $this->view->mensaje = "Datos actualizados correctamente";

            $this->view->render('admin/actualizarAgente');
        } else {
            $this->view->mensaje = "No se pudo actualizar ";

        }

    }
    function eliminar($param = null)
    {
        $codusuario = $param[0];

        if ($this->model->delete($codusuario)) {

            $mensaje = "Agente eliminado correctamente";
        } else {

            $mensaje = "No se pudo eliminar el Agente";
        }
        $this->render();

        echo $mensaje;
    }




}

?>