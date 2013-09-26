<?php

class UsersController extends AppController{
    
    public $name = 'Users';
     
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add'); // Letting users register themselves
    }
    
    public function index(){
        echo 'Hola';
    }

    public function login() {
        if ($this->request->is('post')) {
            //debug($this->request); exit;
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
                //return $this->redirect('/users/index');
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    
    
    
}
?>
