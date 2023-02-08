<?php
//include_once 'SucursalMedicinaModel.php';

class ListaMedicinaModel extends Model{

    private $codMedicina;
    private $nombre;
    private $codigosucursal;
    private $cantidad;
    
    public function __construct()
    {
        parent::__construct();
    }
    public function getAllSucursal(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM sucursal ');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ListaMedicinaModel();
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
    public function getAll_lista(){
        $items = [];
        try{
            $query = $this->db->connect()->query('SELECT medicina.codMedicina,codSucursal,nombre,sucursal_medicina.cantidad   FROM medicina  INNER JOIN sucursal_medicina  WHERE medicina.codMedicina = sucursal_medicina.codMedicina   ORDER BY medicina.codMedicina');
           


            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ListaMedicinaModel();
                $item->fromp($p);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }
    public function toArray(){
        $array = [];
        $array['codMedicina'] = $this->codMedicina;
        $array['codSucursal'] = $this->codigosucursal;
        $array['nombre'] = $this->nombre;
        $array['cantidad'] = $this->cantidad;
       

        return $array;
    }

    public function getAll($codsucu){
        $items = [];
        try{
            $query = $this->prepare('SELECT medicina.codMedicina,nombre,sucursal_medicina.cantidad   FROM medicina  INNER JOIN sucursal_medicina  WHERE medicina.codMedicina = sucursal_medicina.codMedicina AND sucursal_medicina.codSucursal =:codsucu  ORDER BY medicina.codMedicina');
            $query->execute(["codsucu" => $codsucu]);


            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ListaMedicinaModel();
                $item->fromp($p);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }

    
    

    public function fromp($array){
        $this->codMedicina = $array['codMedicina'];
        $this->codigosucursal = $array['codSucursal'];
        $this->nombre = $array['nombre'];
        $this->cantidad = $array['cantidad'];
       
    }



    public function setcodMedicina($codMedicina)
    {
        $this->codMedicina = $codMedicina;
    }
    public function getcodMedicina()
    {
        return $this->codMedicina;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }
    public function getCantidad()
    {
        return $this->cantidad;
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