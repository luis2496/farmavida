<?php
include_once 'models/medicina.php';
class ConsultaModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $items = [];

        try {
            $query = $this->db->connect()->query('SELECT * FROM medicina');

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new Medicina();
                $item->codigo = $row['codMedicina'];
                $item->formula = $row['formula'];
                $item->cantidad = $row['cantidadUnidades'];







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
                $item->formula = $row['formula'];
                $item->cantidad = $row['cantidadUnidades'];
            }
            return $item;
        } catch (PDOException $e) {
            return null;

        }

    }
    public function update($item){
       
            $query = $this->db->connect()->prepare('UPDATE medicina SET formula = :formula ,cantidadUnidades = :cantidadUnidades WHERE codMedicina = :codMedicina');
            try{  $query->execute([
                'codMedicina' => $item['codMedicina'],
                'formula' => $item['formula'],
                'cantidadUnidades'   => $item['cantidadUnidades']
             
                ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }



}
?>