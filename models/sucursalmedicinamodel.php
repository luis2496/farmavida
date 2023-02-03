<?php
include_once 'models/medicinas.php';
class SucursalMedicinaModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $items = [];

        try {
            $query = $this->db->connect()->query('SELECT * FROM sucursal_medicina');

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new Medicinas();
                $item->codigomedicina = $row['codMedicina'];
                $item->codigosucursal = $row['codSucursal'];
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
        $item = new Medicinas();
        $query = $this->db->connect()->prepare('SELECT * FROM sucursal_medicina WHERE codMedicina = :codMedicina');

        try {
            $query->execute(['codMedicina' => $codMedicina]);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $item->codigomedicina = $row['codMedicina'];
                $item->codigosucursal = $row['codSucursal'];
                $item->cantidad = $row['cantidad'];
            }
            return $item;
        } catch (PDOException $e) {
            return null;

        }

    }
    public function update($item)
    {

        $query = $this->db->connect()->prepare('UPDATE sucursal_medicina  SET cantidad = :cantidad WHERE codMedicina = :codMedicina');
        try {
            $query->execute([
                'codMedicina' => $item['codMedicina'],
                'cantidad' => $item['cantidad']

            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }


    public function delete($cod)
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