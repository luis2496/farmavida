<?php
include_once 'models/medicina.php';
include_once 'listamedicinamodel.php';
class ConsultaModel extends Model
{
    private $codigo;
    private $nombre;
    private $codSucursal;
    private $cantidad;

    public function __construct()
    {
        parent::__construct();
    }

    public function setcodMedicina($codigo)
    {
        $this->codigo = $codigo;
    }
    public function getcodMedicina()
    {
        return $this->codigo;
    }

    public function getAllMedicina(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM medicina ');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ConsultaModel();
                $item->from($p); 
                
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }
    
    public function from($array){
      
        $this->codigo = $array['codMedicina'];
       
       
    }

 



    public function actualizarinventario($item){
       
        $query = $this->db->connect()->prepare('UPDATE medicina SET cantidad = cantidad-:cantidad  WHERE codMedicina = :codMedicina');
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
    public function Sumarinventario($item)
    {

        $query = $this->db->connect()->prepare('UPDATE medicina SET cantidad = cantidad+:cantidad  WHERE codMedicina = :codMedicina');
        try {
            $query->execute([
                'codMedicina' => $item['codMedicina'],
                'cantidad' => $item['cantidad'],


            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }
    
    
    public function insert($datos){
        // insertar
        $query = $this->db->connect()->prepare('INSERT INTO medicina (codMedicina, nombre, cantidad) VALUES(:codMedicina, :nombre, 0)');
        try{
            $query->execute([
                'codMedicina' => $datos['codMedicina'],
                'nombre' => $datos['nombre'],
               // 'cantidad' => $datos['cantidad']
               
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
        
    }
    public function registrarmedicinassucursal($datos){
        // insertar
        $query = $this->db->connect()->prepare('INSERT INTO sucursal_medicina (codMedicina, codSucursal, cantidad) VALUES(:codMedicina, :codSucursal,:cantidad)');
        try{
            $query->execute([
                'codMedicina' => $datos['codMedicina'],
                'codSucursal' => $datos['codSucursal'],
                'cantidad' => $datos['cantidad'],
                //'cantidad' => $datos['0']
               
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
        
    }
    public function get()
    {
        $items = [];

        try {
            $query = $this->db->connect()->query('SELECT * FROM medicina');

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new Medicina();
                $item->codigo = $row['codMedicina'];
                $item->nombre = $row['nombre'];
                $item->cantidad = $row['cantidad'];







                array_push($items, $item);
            }
            return $items;


        } catch (PDOException $e) {
            echo $e;
        }


    }
   
    public function getById($codMedicina)
    {
        $item = new Medicina();
        $query = $this->db->connect()->prepare('SELECT * FROM medicina WHERE codMedicina = :codMedicina');

        try {
            $query->execute(['codMedicina' => $codMedicina]);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $item->codigo = $row['codMedicina'];
                $item->nombre = $row['nombre'];
                $item->cantidad = $row['cantidad'];
            }
            return $item;
        } catch (PDOException $e) {
            return null;

        }

    }
    public function update($item){
       
            $query = $this->db->connect()->prepare('UPDATE medicina SET nombre = :nombre  WHERE codMedicina = :codMedicina');
            try{  $query->execute([
                'codMedicina' => $item['codMedicina'],
                'nombre' => $item['nombre'],
                //'cantidad'   => $item['cantidad']
             
                ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }
    public function delete($cod)
    {

        $query = $this->db->connect()->prepare('DELETE FROM medicina   WHERE codMedicina = :cod');
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
    public function deletesucursal($cod)
    {

        $query = $this->db->connect()->prepare('DELETE FROM sucursal_medicina   WHERE codMedicina = :cod');
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



}
?>