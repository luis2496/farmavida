<?php

class UsuarioModel extends Model implements IModel{

    private $codusuario;
    private $username;
    private $password;
    private $role;
    
   

    public function __construct(){
        parent::__construct();
        
        
        $this->codusuario = '';
        $this->username = '';
        $this->password = '';
        $this->role = '';
       
       
     
    }

    
    

    
   



    function comparePasswords($current, $userid){
        try{
            $query = $this->db->connect()->prepare('SELECT codusuario, password FROM usuario WHERE codusuario = :codusuario');
            $query->execute(['codusuario' => $userid]);
            
            if($row = $query->fetch(PDO::FETCH_ASSOC)) return password_verify($current, $row['password']);

            return NULL;
        }catch(PDOException $e){
            return NULL;
        }
    }
    

    public function save(){
        try{
            $query = $this->prepare('INSERT INTO usuario (codusuario,username, password, role) VALUES(:codusuario,:username, :password, :role )');
            $query->execute([
                'codusuario'  => $this->codusuario, 
                'username'  => $this->username, 
                'password'  => $this->password,
                'role'      => $this->role,
              
               
                ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    } 

    

    public function get($cod){
        try{
            $query = $this->prepare('SELECT * FROM usuario WHERE codusuario = :codusuario');
            $query->execute([ 'codusuario' => $cod]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            $this->codusuario = $user['codusuario'];
            $this->username = $user['username'];
            $this->password = $user['password'];
            $this->role = $user['role'];
           
           

            return $this;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($cod){
        try{
            $query = $this->prepare('DELETE FROM usuario WHERE codusuario = :codusuario');
            $query->execute([ 'codusuario' => $cod]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function update(){
        try{
            $query = $this->prepare('UPDATE usuario SET username = :username, password = :password WHERE codusuario = :codusuario');
            $query->execute([
                'codusuario'        => $this->codusuario,
                'username' => $this->username, 
                'password' => $this->password,
                
                
                ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function exists($username){
        try{
            $query = $this->prepare('SELECT username FROM usuario WHERE username = :username');
            $query->execute( ['username' => $username]);
            
            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function from($array){
        $this->codusuario = $array['codusuario'];
        $this->username = $array['username'];
        $this->password = $array['password'];
        $this->role = $array['role'];
        
      
    }

    private function getHashedPassword($password){
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }

    public function setUsername($username){ $this->username = $username;}
    //FIXME: validar si se requiere el parametro de hash
    public function setPassword($password, $hash = true){ 
        if($hash){
            $this->password = $this->getHashedPassword($password);
        }else{
            $this->password = $password;
        }
    }
    public function setCod($codusuario){             $this->codusuario = $codusuario;}
    public function setRole($role){         $this->role = $role;}
   
  

    public function getCod(){        return $this->codusuario;}
    public function getUsername(){  return $this->username;}
    public function getPassword(){  return $this->password;}
    public function getRole(){      return $this->role;}
   
   
	/**
	 * @return mixed
	 */
	public function getAll() 
    {
	}
}

?>