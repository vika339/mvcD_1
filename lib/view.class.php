        <?php
            class View{
            protected $data;
            protected $path;
                //правильно определить путь к шаблону без создания обїекта
                protected static function getDefaultViewPath(){
                    $router = App::getRouter();
                    if (!$router){
                        return false;
                    }
                    $controller_dir = $router->getController();
                    $template_name = $router->getMethodPrefix().$router->getAction().'.html';
                    return VIEWS_PATH.DS.$controller_dir.DS.$template_name;
                }
                public function __construct($data = array(), $path = null)
                {
                    if (!$path){
                    //если $path не задана или пустая будем определять ее самостоятельно
                       $path = self::getDefaultViewPath();

                    }
                    if (!file_exists($path)){
                        throw new Exception('Template file is not found in path: '.$path);
                    }
                    $this->path = $path;
                    $this->data =$data;
                }
                // функция будет возвращать html код
                public function render(){
                    //эта переменная связывающее звено между контроллером и шаблоном
                    $data = $this->data;
                    //буферизация вывода
                    ob_start();
                    include ($this->path);
                    $content = ob_get_clean();
                    return $content;
                }
            }