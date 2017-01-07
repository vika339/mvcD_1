<?php
//класс отвечает за парсинг запросов приложения(разобрать uri получить контроллер метод и др части)

class Router{
    protected $uri;
    protected $controller;
    protected $action;
    protected $params;
    protected $route;
    protected $method_prefix;
    protected $language;

    //создаем геттеры для доступа к этим переменным

    /**
     * @return mixed
     */
    public function getUri(){
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getController(){
        return $this->controller;
    }

    /**
     * @return mixed|null
     */
    public function getAction(){
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParams(){
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getRoute(){
        return $this->route;
    }

    /**
     * @return string
     */
    public function getMethodPrefix(){
        return $this->method_prefix;
    }

    /**
     * @return string
     */
    public function getLanguage(){
        return $this->language;
    }
    //в конструктор добавляем метод который будет получать парсингзапросы
    /**
     * Router constructor.
     * @param $uri
     */
    public function __construct($uri){
        //trim очищаем uri от "/"
        $this->uri = urldecode(trim($uri, '/'));
       // urldecode правильно обрабатываем закодированные символы

    //Get defaults(получить настройки по умолчанию)
        $routes = Config::get('routes');
        $this->route = Config::get('default_route');
        $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
        $this->language = Config::get('default_language');
        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');
        //разделим uri и уберем знак ? если он присутствует в запросе и  get параметров
        $uri_parts = explode('?', $this->uri);
        //Get path like/lng/controller/action/param1/param2/.../.../
        // теперь строка очищенная будет находится в массиве uri_parts по индексу 0
        $path = $uri_parts[0];
        //теперь разделим строку по слешам и выведим в массив
        $path_parts = explode('/', $path);
        //echo "<pre>"; print_r($path_parts);
        //проверяем массив на не пустоту
        if (count($path_parts)){
            //Get rout or language at first element
            //проходим по всем єлементам массива и разбираем их на составляющие
            if ( in_array(strtolower(current($path_parts)), array_keys($routes)) )
            {
                $this->route = strtolower(current($path_parts));
                $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
                array_shift($path_parts);
            }
            //если 1й елемент не оказался явно указаным rout  то проверим не является ли он кодом языка
            elseif ( in_array(strtolower(current($path_parts)), Config::get('languages')) ){
                $this->language = strtolower(current($path_parts));
                //сдвинем массив
                array_shift($path_parts);
            }
            //Get controller - next element of array
            //если елемент контроллер не пустой то запишем в атрибут controller
            if (current($path_parts)){
                $this->controller = strtolower(current($path_parts));
                array_shift($path_parts);
            }
            //Get action
            if (current($path_parts)) {
                $this->action = strtolower(current($path_parts));
                array_shift($path_parts);
            }
            //все оставшиеся єлементы єто параметры
            //зададим атрибуты в объекте роутера
            //Get paran - all the rest
            $this->params=$path_parts;

        }

    }
    //ф-я для перенаправления на список страниц (для админа)
    public static function redirect($location){
        header("Location: $location");
    }
}