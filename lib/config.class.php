<?php
class Config{
   // создаем массив для хранения настроек ключ-значение
    protected static $settings = array();
    //возвращение значения ключа если он существует
    public static function get($key){
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }
    //присваивание значения эл-ту массива по ключу(для установки и получения настроек приложения)
    public static function set($key, $value){
        self::$settings[$key] = $value;
    }
}