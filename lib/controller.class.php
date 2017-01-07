<?php
class Controller{
    //содержит всю инф которая будет передаваться из контролера в представление
    protected $data;
    //для доступа к объекту модели
    protected $model;
    //здесь будут храниться параметрі полученніе из строки запроса
    protected $params;

    /**
     * @return mixed
     */
    public function getData(){
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getModel(){
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getParams(){
        return $this->params;
    }
    public function __construct($data = array()){
        $this->data = $data;
        $this->params = App::getRouter()->getParams();
    }

}