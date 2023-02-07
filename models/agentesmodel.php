<?php
include_once 'models/agente.php';
class AgentesModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }





    public function insert($datos){
        // insertar
        $query = $this->db->connect()->prepare('INSERT INTO usuario_agente (codusuario, codsucursal,cedula, nombre,apellido,direccion,telefono) VALUES(:codusuario, :codsucursal,:cedula, :nombre,:apellido,:direccion,:telefono)');
        try{
            $query->execute([
                'codusuario' => $datos['codusuario'],
                'codsucursal' => $datos['codsucursal'],
                'cedula' => $datos['cedula'],
                'nombre' => $datos['nombre'],
                'apellido' => $datos['apellido'],
                'direccion' => $datos['direccion'],
                'telefono' => $datos['telefono'],

               
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
            $query = $this->db->connect()->query('SELECT * FROM usuario_agente');

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new Agente();
                $item->codusuario = $row['codusuario'];
                $item->codsucursal = $row['codsucursal'];
                $item->cedula = $row['cedula'];

                $item->nombre = $row['nombre'];
                $item->apellido = $row['apellido'];
                $item->direccion = $row['direccion'];
                $item->telefono = $row['telefono'];


                array_push($items, $item);
            }
            return $items;


        } catch (PDOException $e) {
            echo $e;
        }


    }

    public function getById($codusuario)
    {
        $item = new Agente();
        $query = $this->db->connect()->prepare('SELECT * FROM usuario_agente WHERE codusuario = :codusuario');

        try {
            $query->execute(['codusuario' => $codusuario]);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $item->codusuario = $row['codusuario'];
                $item->codsucursal = $row['codsucursal'];
                $item->cedula = $row['cedula'];
                $item->nombre = $row['nombre'];
                $item->apellido = $row['apellido'];
                $item->direccion = $row['direccion'];
                $item->telefono = $row['telefono'];
            }
            return $item;
        } catch (PDOException $e) {
            return null;

        }

    }
    public function update($item){
       
            $query = $this->db->connect()->prepare('UPDATE usuario_agente SET codsucursal = :codsucursal,cedula = :cedula,nombre = :nombre,apellido = :apellido,direccion = :direccion,telefono = :telefono WHERE codusuario = :codusuario');
            try{  $query->execute([
                'codusuario' => $item['codusuario'],
                'codsucursal' => $item['codsucursal'],
                'cedula' => $item['cedula'],
                'nombre' => $item['nombre'],
                'apellido' => $item['apellido'],
                'direccion' => $item['direccion'],
                'telefono'   => $item['telefono']
             
                ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function delete($cod)
    {

        $query = $this->db->connect()->prepare('DELETE FROM usuario_agente   WHERE codusuario = :cod');
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