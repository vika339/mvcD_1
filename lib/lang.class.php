<?php
class Lang{
// хранит языковые настройки
protected static $data;
    public static function load($lang_code){
        //ф-я будет загружать данные из языковых файлов и записывать языковые настройки в атрибут data
        //путь языкового файла
        $lang_file_path = ROOT.DS.'lang'.DS.strtolower($lang_code).'.php';
        //проверка на существование данного пути
        if (file_exists($lang_file_path)){
            self::$data = include($lang_file_path);

        }else{
        //если файл не найден возбуждаем исключение
            throw new Exception('Lang file not found:'.$lang_file_path);
        }
    }
    //ф-я будет принимать ключ в качестве аргумента и возвращать значение для загруженного языка
    public static function get($key, $default_value = ''){
        return isset(self::$data[strtolower($key)]) ? self::$data[strtolower($key)] : $default_value;

    }
}