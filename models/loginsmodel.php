<?php

class LoginsModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function login($username, $password){
     
        try{
            
            $query = $this->prepare('SELECT * FROM USUARIO WHERE username = :username');
            $query->execute(['username' => $username]);
            
            if($query->rowCount() == 1){
                $item = $query->fetch(PDO::FETCH_ASSOC); 

                $usuario = new UsuarioModel();
                $usuario->from($item);

    

               if($password== $usuario->getPassword())
              {
                return $usuario;

              }
              else

                if(password_verify($password, $usuario->getPassword())){   
               
                    
                    return $usuario;
                   
                }
                
                
                else{
                    return NULL;
                }
            }
        }catch(PDOException $e){
            return NULL;
        }
    }

    

}

?>