<?php
//отвечает за обработку запросов и вызывает методы контроллеров
//создаем необходимый объект контроллера и вызываем нужный метод(главная его задача)
class App{
    protected static $router;
    public static $db;

    /**
     * @return mixed
     */
    public static function getRouter(){
        return self::$router;
    }
    //метод будет отвечать за обработку запрсов к приложению(получаемый параметр uri для создания объектов роутера)
    public static function run($uri){
        self::$router = new Router($uri);

        self::$db = new DB(Config::get('db.host'), Config::get('db.user'), Config::get('db.password'), Config::get('db.db_name'));

        //получение используемого языка(яз настройки загр автом после созд объекта роутера
        Lang::load(self::$router->getLanguage());


       // получаем название класса контроллера и название метода
        $controller_class = ucfirst(self::$router->getController()).'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());
        $layout = self::$router->getRoute();


        //проверка вошел пользователь(админ)
       if ($layout == 'admin' && Session::get('role')  != 'admin'){
            if ($controller_method != 'admin_login'){
                Router::redirect('/admin/users/login');
            }
        }



        //создадим объект
        //Calling controller's method
        $controller_object = new $controller_class;
        //сделаем проверку на существование
        if (method_exists($controller_object, $controller_method)){
            //получить данные от контроллера и передать их представлению
            //Controller's action may return a view path

            $view_path = $controller_object->$controller_method();

            //если значение представления не определяются то путь к шаблону след-й
            $view_object = new View($controller_object->getData(), $view_path);
            //контент для основного шаблона(результат рендеринга)
            $content = $view_object->render();

        }
        //возбудим исклочение
        else{
            throw new Exception('Metod '.$controller_method.' of class '.$controller_class.' does not exist.');
        }
        //выполняем рендеринг
        //название роутера

        $layout_path = VIEWS_PATH.DS.$layout.'.html';
        $layout_view_object = new View(compact('content'), $layout_path);
        echo  $layout_view_object->render();


    }

}