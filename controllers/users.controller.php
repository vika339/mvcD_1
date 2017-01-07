<?php
class UsersController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new User();
    }

    public function admin_login(){


        //если данные переданы
        if ($_POST && isset($_POST['login']) && isset($_POST['password'])){
            $user = $this->model->getByLogin($_POST['login']);
            $hash = md5(Config::get('salt').$_POST['password']);
            //если данные совпадают
            if ($user && $user['is_active'] && $hash == $user['password']){
                //запишем данные в сесию
                Session::set('login', $user['login']);
                Session::set('role', $user['role']);
            }
            //администратор попадет в админпанель
            Router::redirect('/admin/');
        }

    }
    //функция для выхода из системы (уничтожение сесии)
    public function admin_logout(){
        Session::destroy();
        Router::redirect('/admin/');
    }
}