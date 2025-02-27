<?php
include_once 'models/sucursal.php';
class SucursalsModel extends Model
{
    private $codSucursal;
    

    public function __construct()
    {
        parent::__construct();
    }

    public function setcodigosucursal($codSucursal)
    {
        $this->codSucursal = $codSucursal;
    }
    public function getcodigosucursal()
    {
        return $this->codSucursal;
    }
   



    public function insert($datos){
        // insertar
        $query = $this->db->connect()->prepare('INSERT INTO sucursal (codSucursal, estado, ciudad,direccion) VALUES(:codSucursal, :estado, :ciudad,:direccion)');
        try{
            $query->execute([
                'codSucursal' => $datos['codSucursal'],
                'estado' => $datos['estado'],
                'ciudad' => $datos['ciudad'],
                'direccion' => $datos['direccion']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
        
        
    }
    public function getAlls($codsucu){
        $items = [];
        try{
            $query = $this->prepare('SELECT medicina.codMedicina,nombre,medicina.cantidad   FROM medicina  INNER JOIN sucursal_medicina  WHERE medicina.codMedicina = sucursal_medicina.codMedicina AND sucursal_medicina.codSucursal =:codsucu  ORDER BY medicina.codMedicina');
            $query->execute(["codsucu" => $codsucu]);


            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ListaMedicinaModel();
                $item->codMedicina = $row['codMedicina'];
                $item->nombre = $row['nombre'];
                $item->cantidad = $row['cantidad'];
             
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }


    public function get()
    {
        $items = [];

        try {
            $query = $this->db->connect()->query('SELECT * FROM sucursal');

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new Sucursal();
                $item->codSucursal = $row['codSucursal'];
                $item->estado = $row['estado'];
                $item->ciudad = $row['ciudad'];

                $item->direccion = $row['direccion'];
                

                array_push($items, $item);
            }
            return $items;


        } catch (PDOException $e) {
            echo $e;
        }


    }

    public function getById($codSucursal)
    {
        $item = new Sucursal();
        $query = $this->db->connect()->prepare('SELECT * FROM sucursal WHERE codSucursal = :codSucursal');

        try {
            $query->execute(['codSucursal' => $codSucursal]);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $item->codSucursal = $row['codSucursal'];
                $item->estado = $row['estado'];
                $item->ciudad = $row['ciudad'];
                $item->direccion = $row['direccion'];
               
            }
            return $item;
        } catch (PDOException $e) {
            return null;

        }

    }
    public function update($item){
       
            $query = $this->db->connect()->prepare('UPDATE sucursal SET estado = :estado,ciudad = :ciudad,direccion = :direccion WHERE codSucursal = :codSucursal');
            try{  $query->execute([
                'codSucursal' => $item['codSucursal'],
                'estado' => $item['estado'],
                'ciudad' => $item['ciudad'],
                'direccion' => $item['direccion'],
               
             
                ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function delete($cod)
    {

        $query = $this->db->connect()->prepare('DELETE FROM sucursal   WHERE codSucursal = :cod');
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