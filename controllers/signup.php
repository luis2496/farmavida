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
        $this->view->render('admin/signup');
    }

    function newUser()
    {
        if ($this->existPOST(['codusuario', 'username', 'password'])) {
            $codusuario = $this->getPost('codusuario');
            $username = $this->getPost('username');
            $password = $this->getPost('password');

            //validate data
            if ($codusuario == '' || empty($codusuario) || $username == '' || empty($username) || $password == '' || empty($password)) {

                $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }

            $user = new UsuarioModel();
            $user->setCod($codusuario);
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRole("user");

            if ($user->existsCod($codusuario)) {

                $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EXISTS]);
                //return;
            } else 
            
            if ($user->save()) {

               $this->redirect('', ['success' => Success::SUCCESS_SIGNUP_NEWUSER]);
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