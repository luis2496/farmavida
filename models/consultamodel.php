<?php
include_once 'models/medicina.php';
class ConsultaModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }



    public function insert($datos){
        // insertar
        $query = $this->db->connect()->prepare('INSERT INTO medicina (codMedicina, nombre, cantidad) VALUES(:codMedicina, :nombre, :cantidad)');
        try{
            $query->execute([
                'codMedicina' => $datos['codMedicina'],
                'nombre' => $datos['nombre'],
                'cantidad' => $datos['cantidad']
               
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
       
            $query = $this->db->connect()->prepare('UPDATE medicina SET nombre = :nombre ,cantidad = :cantidad WHERE codMedicina = :codMedicina');
            try{  $query->execute([
                'codMedicina' => $item['codMedicina'],
                'nombre' => $item['nombre'],
                'cantidad'   => $item['cantidad']
             
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



}
?>