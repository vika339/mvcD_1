<?php
//этот файл подключен к индекс файлу и отвечает за то что весь остальной код имел доступ к настройкам сайта и классам

//подключаем что бы был доступен обьвленный в другом файле класс сонфиг подключаем файл config.php

    require_once(ROOT.DS.'config'.DS.'config.php');

//для использования функций классов и констант объявленных в разных файлах
// эта ф-я вкл автомат когда в коде встречается использование не определенного ранее класса

/**
 * @param $class_name
 * @throws Exception
 */
function __autoload($class_name){
    //создаем переменные которые содержат путь к файлам контроллера модели и представления

    $lib_path = ROOT.DS.'lib'.DS.strtolower($class_name).'.class.php';
    $controllers_path = ROOT.DS.'controllers'.DS.str_replace('controller', '',strtolower($class_name)).'.controller.php';
    $model_path = ROOT.DS.'models'.DS.strtolower($class_name).'.php';

    if ( file_exists ($lib_path)){
        require_once($lib_path);
    }
    elseif (file_exists($controllers_path)){
        require_once ($controllers_path);
    } elseif (file_exists($model_path)){
        require_once ($model_path);
    }
    //если класс не найден создаем исключение
    else {
        throw new Exception('Filed to include class: '. $class_name);
}
}
//ф-я будет вызывать гет для языка и принимать одни и те же аргументы позволит вызывать знач яз ключа
function __($key, $default_value = ''){
    return Lang::get($key, $default_value);

}

