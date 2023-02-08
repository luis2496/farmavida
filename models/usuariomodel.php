<?php
include_once 'agentes.php';
class UsuarioModel extends Model implements IModel
{

    private $codusuario;
    private $codsucursal;
    private $username;
    private $password;
    private $role;
    private $nombres;


    public function __construct()
    {
        parent::__construct();


        $this->codusuario = '';
        $this->codsucursal = '';
        $this->username = '';
        $this->password = '';
        $this->role = '';
        $this->nombres = '';



    }


    public function getAll()
    {
        $items = [];

        try {
            $query = $this->query('SELECT * FROM usuario where role="user"');

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new UsuarioModel();
                $item->from($p);

                array_push($items, $item);
            }

            return $items;

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getById($codusuario)
    {
        $item = new Agentes();
        $query = $this->db->connect()->prepare('SELECT * FROM usuario WHERE codusuario = :codusuario');

        try {
            $query->execute(['codusuario' => $codusuario]);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $item->codusuario = $row['codusuario'];
                $item->codsucursal = $row['codsucu'];

                $item->username = $row['username'];
                $item->password = $row['password'];
                $item->role = $row['role'];
                $item->nombres = $row['nombres'];
            }
            return $item;
        } catch (PDOException $e) {
            return null;

        }

    }

    public function update($item){
       
        $query = $this->db->connect()->prepare('UPDATE usuario SET username = :username,password = :password,nombres = :nombres WHERE codusuario = :codusuario');
        try{  $query->execute([
            'codusuario' => $item['codusuario'],
           
            'username' => $item['username'],
            'password' => $item['password'],
           
            'nombres' => $item['nombres']
           
         
            ]);
        return true;
    }catch(PDOException $e){
        echo $e;
        return false;
    }
}
    public function actualizar(){
        try{
            $query = $this->prepare('UPDATE usuario SET codsucu = :codsucu, username = :username, password = :password, nombres = :nombres WHERE codusuario = :codusuario');
            $query->execute([
                'codusuario'        => $this->codusuario,
                'codsucu' => $this->codsucursal, 
                'username' => $this->username,
                'password' => $this->password,
                'nombres' => $this->nombres
                
                ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }
   /* public function update($item)
    {

        $query = $this->db->connect()->prepare('UPDATE usuario SET codsucu = :codsucu, username = :username, password = :password, nombres = :nombres WHERE codusuario = :codusuario');
        try {
            $query->execute([
                'codusuario' => $item['codusuario'],
                'codsucu' => $item['codsucu'],
                'username' => $item['username'],
                'password' => $item['password'],

                'nombres' => $item['nombres']

            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }*/



    function comparePasswords($current, $userid)
    {
        try {
            $query = $this->db->connect()->prepare('SELECT codusuario, password FROM usuario WHERE codusuario = :codusuario');
            $query->execute(['codusuario' => $userid]);

            if ($row = $query->fetch(PDO::FETCH_ASSOC))
                return password_verify($current, $row['password']);

            return NULL;
        } catch (PDOException $e) {
            return NULL;
        }
    }


    public function save()
    {
        try {
            $query = $this->prepare('INSERT INTO usuario (codusuario,codsucu,username, password, role,nombres) VALUES(:codusuario,:codsucu,:username, :password, :role,:nombres )');
            $query->execute([
                'codusuario' => $this->codusuario,
                'codsucu' => $this->codsucursal,
                'username' => $this->username,
                'password' => $this->password,
                'role' => $this->role,
                'nombres' => $this->nombres,


            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }



    public function get($codusuario)
    {
        try {
            $query = $this->prepare('SELECT * FROM usuario WHERE codusuario = :codusuario');
            $query->execute(['codusuario' => $codusuario]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            $this->codusuario = $user['codusuario'];
            $this->codsucursal = $user['codsucu'];
            $this->username = $user['username'];
            $this->password = $user['password'];
            $this->role = $user['role'];
            $this->nombres = $user['nombres'];



            return $this;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($cod)
    {
        try {
            $query = $this->prepare('DELETE FROM usuario WHERE codusuario = :codusuario');
            $query->execute(['codusuario' => $cod]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }


    public function existsCod($codusuario)
    {
        try {
            $query = $this->prepare('SELECT codusuario FROM usuario WHERE codusuario = :codusuario');
            $query->execute(['codusuario' => $codusuario]);

            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }
    public function exists($username)
    {
        try {
            $query = $this->prepare('SELECT username FROM usuario WHERE username = :username');
            $query->execute(['username' => $username]);

            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function from($array)
    {
        $this->codusuario = $array['codusuario'];
        $this->codsucursal = $array['codsucu'];
        $this->username = $array['username'];
        $this->password = $array['password'];
        $this->role = $array['role'];
        $this->nombres = $array['nombres'];


    }

    private function getHashedPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    //FIXME: validar si se requiere el parametro de hash
    public function setPassword($password, $hash = true)
    {
        if ($hash) {
            $this->password = $this->getHashedPassword($password);
        } else {
            $this->password = $password;
        }
    }
    public function setCod($codusuario)
    {
        $this->codusuario = $codusuario;
    }
    public function setcodsucursal($codsucursal)
    {
        $this->codsucursal = $codsucursal;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }



    public function getCod()
    {
        return $this->codusuario;
    }
    public function getcodsucursal()
    {
        return $this->codsucursal;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getNombres()
    {
        return $this->nombres;
    }
/**
 * @return mixed
 */

}

?>