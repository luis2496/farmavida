
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


    

}

?>