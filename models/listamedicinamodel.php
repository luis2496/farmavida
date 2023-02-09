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

public function actualizarinventario($item){
       
        $query = $this->db->connect()->prepare('UPDATE medicina SET cantidad = cantidad - :cantidad  WHERE codMedicina = :codMedicina');
        try{  $query->execute([
            'codMedicina' => $item['codMedicina'],
            'cantidad'   => $item['cantidad'],
           
         
            ]);
        return true;
    }catch(PDOException $e){
        echo $e;
        return false;
    }
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

    public function getAllSucursalMedicina($codsucu){
        $items = [];

        try{
            $query = $this->prepare('SELECT * FROM sucursal_medicina where codMedicina=:codMedicina ');
            $query->execute(["codMedicina" => $codsucu]);
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

    
    
    

    public function fromp($array){
        $this->codMedicina = $array['codMedicina'];
        $this->codigosucursal = $array['codSucursal'];
        $this->nombre = $array['nombre'];
        $this->cantidad = $array['cantidad'];
       
    }

    public function delete($cod)
    {

        $query = $this->db->connect()->prepare('DELETE FROM sucursal_medicina   WHERE  codMedicina = :cod');
        try {
            $query->execute([
                'cod' => $cod,
                


            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
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