<?php
//вывод флеш месседжис
class Session{
    //text message
    protected static $flash_message;
    public static function setFlash($message){
        self::$flash_message = $message;
    }
    // проверка наличия послания для пользователя
    public static function hasFlash(){
        return !is_null(self::$flash_message);
    }
    //вывести текущее сообщение и после этого очистить
    public static function flash(){
        echo self::$flash_message;
        self::$flash_message = null;
    }
    //запись данных в массив ссешн по ключу
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }
    //получение значения из сесии
    public static function get($key){
        if (isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }
    //если нужно удалить ключ и значение из сесии
    public static function delete($key){
        if (isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }
    //уничтожение сесии при выходе пользователя из системы
    public static function destroy(){
        session_destroy();
    }
}
