<?php


class Signup extends SessionController
{

    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->view->errorMessage = '';
        $this->view->render('admin/signup', [
            'sucursals' => $this->getListSucursal()
        ]);
    }
    private function getListSucursal(){
        $res = [];
        $signupsucursal = new SignupModel();
        $sucursals = $signupsucursal->getAll();

        foreach ($sucursals as $sucursal) {
            array_push($res, $sucursal->getcodigosucursal());
        }
        $res = array_values(array_unique($res));

        return $res;
    }

     


    function newUser()
    {
        if ($this->existPOST(['codusuario','codsucu', 'username', 'password', 'nombres'])) {
          
            $codusuario = $this->getPost('codusuario');
            $codsucursal = $this->getPost('codsucu');
            $username = $this->getPost('username');
            $password = $this->getPost('password');
            $nombres = $this->getPost('nombres');
            //validate data
            if ($codusuario == '' || empty($codusuario) || $codsucursal == '' || empty($codsucursal) || $username == '' || empty($username) || $password == '' || empty($password)|| $nombres == '' || empty($nombres)) {

                $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }

            $user = new UsuarioModel();
            $user->setCod($codusuario);
            $user->setcodsucursal($codsucursal);
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRole("user");
            $user->setNombres($nombres);

            if ($user->existsCod($codusuario)) {

                $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EXISTS]);
                //return;
            } else 
            
            if ($user->save()) {

               $this->redirect('signup', ['success' => Success::SUCCESS_SIGNUP_NEWUSER]);
            } else
             {

               $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER]);
            }
        } else {

            $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EXISTS]);
        }
    }
}

?>