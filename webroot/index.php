<?php
//ds разделяем директории в windows

    define('DS', DIRECTORY_SEPARATOR);

//root указывает на директорию на2 уровня выше чем index.php т.е будет указывать на корневую дир-ю прил-я для вкл ф-в

    define('ROOT',dirname(dirname(__FILE__)));
// определяем константу которая будет содержать путь к папке представления проэкта
    define('VIEWS_PATH', ROOT.DS.'views');

//включаем файл init.php
    require_once (ROOT.DS.'lib'.DS.'init.php');

    /*$router= new Router($_SERVER['REQUEST_URI']);
echo "<pre>";
print_r('Route:'.$router->getRoute().PHP_EOL);
print_r('Language:'.$router->getLanguage().PHP_EOL);
print_r('Controller:'.$router->getController().PHP_EOL);
print_r('Action to be called:'.$router->getMethodPrefix().$router->getAction().PHP_EOL);
echo "Params:";
print_r($router->getParams());*/



    //проверка вівода флеш сообщения
//Session::setFlash('test flash message');

    session_start();

App::run($_SERVER['REQUEST_URI']);
//вывод из бд
/*$test = App::$db->query('select * from pages');
echo "<pre>";
print_r($test);*/

