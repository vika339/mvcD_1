<?php
//наприме стр о нас
class PagesController extends Controller {
    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Page();
    }

    //будет выводить список страниц
    public function index(){
        $this->data['pages'] =  $this->model->getList();
    }
    public function view(){
        //получим алиас запрашиваемой страницы(параметр запроса)
        $params = App::getRouter()->getParams();
        //проверим задан ли первый параметр
        if ( isset($params[0]) ){
            $alias = strtolower($params[0]);
            $this->data['page'] = $this->model->getByAlias($alias);
        }

    }
    //ф-я админпанели
    public function admin_index(){
//получаем список страниц для админа
        $this->data['pages'] = $this->model->getList();


    }
    public function admin_add(){
        if ($_POST){
          $result = $this->model->save($_POST);
            if ($result){
                Session::setFlash('Page was saved.');
            } else{
                Session::setFlash('Error.');
            }
            Router::redirect('/admin/pages/');
        }
    }
    //добавляем метод редактирования страницы с заполнеными полями ввода(для админ)
    public function admin_edit(){

        if ($_POST){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->save($_POST, $id);
            if ($result){
                Session::setFlash('Page was save.');
            } else{
                Session::setFlash('Error.');
            }
            Router::redirect('/admin/pages/');
        }
        //проверяем что ид страницы задан в параметрах запроса
        if (isset($this->params[0])){
            //запишем
            $this->data['page'] = $this->model->getById($this->params[0]);

        } //если нет то сообщение и перенаправим обратно на список страниц
        else{
            Session::setFlash('Wrong page id.');
            Router::redirect('/admin/pages/');
        }


    }
    public function admin_delete(){
        if (isset($this->params[0])) {
            $result = $this->model->delete($this->params[0]);

        if ($result){
            Session::setFlash('Page was deleted.');
        } else{
            Session::setFlash('Error.');
        }
        }
        Router::redirect('/admin/pages/');

    }
}