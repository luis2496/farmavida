<?php
include_once 'models/medicinas.php';

class SucursalMedicinaModel extends Model
{
    private $codigomedicina;
    private $codigosucursal;

    private $cantidad;



    public function __construct()
    {
        parent::__construct();

        $this->codigomedicina = '';
        $this->codigosucursal = '';
        $this->cantidad = '';
    }
    public function getAll($userid){
        $items = [];
        try{
            $query = $this->prepare('SELECT codSucursal,codMedicina,cantidad FROM sucursal_medicina INNER JOIN usuario WHERE codSucursal = usuario.codsucu AND usuario.codusuario = :userid ORDER BY codMedicina');
            $query->execute(["userid" => $userid]);


            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new SucursalMedicinaModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }
    public function getcod($codigosucursal)
    {
        try {
            $query = $this->prepare('SELECT * FROM sucursal_medicina WHERE codSucursal = :codigosucursal');
            $query->execute(['codigosucursal' => $codigosucursal]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            $this->from($user);

            return $this;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function from($array){
        $this->codigomedicina = $array['codMedicina'];
        $this->codigosucursal = $array['codSucursal'];
        $this->cantidad = $array['cantidad'];
       
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

    public function setcodmedicina($codigomedicina)
    {
        $this->codigomedicina = $codigomedicina;
    }
    public function getcodmedicina()
    {
        return $this->codigomedicina;
    }
    public function setcodigosucursal($codigosucursal)
    {
        $this->codigosucursal = $codigosucursal;
    }
    public function getcodigosucursal()
    {
        return $this->codigosucursal;
    }
    public function setcantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }
    public function getcantidad()
    {
        return $this->cantidad;
    }

}
?>