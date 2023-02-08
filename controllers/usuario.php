<?php

class Usuario extends SessionController
{
    
    function __construct()
    {
        parent::__construct();
        $this->view->agente = [];
    }

    function render()
    {
       // $medicinas = $this->model->get();
        //$this->view->medicina = $medicinas;
        $this->view->render('admin/consultaragente', [
            
            'agentes' => $this->getListAgentes()
        ]);
    }
  
    private function getListAgentes(){
        $res = [];
        $usuariomodel = new UsuarioModel();
        $agentes = $usuariomodel->getAll();

        foreach ($agentes as $agente) {
         
          $agentesArray = [];
          $agentesArray['agente'] = $agente;
         
          array_push($res, $agentesArray);

        }
    

        return $res;
    }


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
        $codsucursal = $_POST['codsucu'];
        $username = $_POST['username'];
        $password = $_POST['password'];
       // $role = $_POST['role'];
        $nombres = $_POST['nombres'];
       


        if ($this->model->update(['codusuario' => $codusuario, 'codsucu' => $codsucursal, 'username' => $username,'password' => $password,'nombres' => $nombres])) {
            // actualizar agente exito
            $agentes = new Agente();
          
            $agentes->codusuario = $codusuario;
            $agentes->codsucursal = $codsucursal;
            $agentes->username = $username;
            $agentes->password = $password;
           // $agentes->role = $role;
            $agentes->nombres = $nombres;
            


            $this->view->agentes = $agentes;

            $this->view->mensaje = "Datos actualizados correctamente";

            $this->view->render('admin/actualizarAgente');
        } else {
            $this->view->mensaje = "No se pudo actualizar ";

        }

    }


    function delete($params){
        
        if($params === NULL) $this->redirect('usuario', ['error' => Errors::ERROR_ADMIN_NEWCATEGORY_EXISTS]);
        $cod = $params[0];
       
        $res = $this->model->delete($cod);

        if($res){
            $this->redirect('usuario', ['success' => Success::SUCCESS_EXPENSES_DELETE]);
        }else{
            $this->redirect('usuario', ['error' => Errors::ERROR_ADMIN_NEWCATEGORY_EXISTS]);
        }
    }


    
}

?>