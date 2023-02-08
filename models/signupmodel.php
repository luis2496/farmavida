<?php


class SignupModel extends Model
{
    
    private $codigosucursal;

   



    public function __construct()
    {
        parent::__construct();

       
        $this->codigosucursal = '';
     
    }

    public function getAll(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM sucursal ');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new SignupModel();
                $item->from($p); 
                
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }
    
    public function from($array){
      
        $this->codigosucursal = $array['codSucursal'];
       
       
    }

    
    
    
    
    public function setcodigosucursal($codigosucursal)
    {
        $this->codigosucursal = $codigosucursal;
    }
    public function getcodigosucursal()
    {
        return $this->codigosucursal;
    }
   

}
?>