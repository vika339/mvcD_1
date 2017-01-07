<?php
 //главный конфигурационный файл хранит название саита параметры подкл к бд
 // создадим настроки сайта
 //название сайта
Config::set('site_name', 'Your Site Name');
//выбор языка
Config::set('languages', array('en', 'fr', 'ru'));
//Routes. Route name => method prefix для различия префиксов пользователя и админа
Config::set('routes', array(
    'default' => '',
    'admin' => 'admin_',
));
//если префикс по умолчанию то пользовательский роут если админ то админ роут
Config::set('default_route', 'default');
//задаем язык по умолчанию
Config::set('default_language', 'ru');
//задаем контроллер по умолчанию с ключом pages
Config::set('default_controller', 'pages');
//задаем метод по умолчанию (первая стр)
Config::set('default_action', 'index');

// настройки для бд
Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'mvc');

//настройка соль(случ наб-р символов против взлома)
Config::set('salt', 'sdg6shf9fhrr3sdgfs0gh');
