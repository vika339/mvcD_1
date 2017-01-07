<?php
class Message extends Model{
    //ф-я запросі к бд для добавления либо обновления таб сообщений
    public function save($data, $id = null){
        //проверяем что єлемент есть в массиве
        if (!isset($data['name']) || !isset($data['email']) || !isset($data['message'])){
            return false;

        }
        // если проверка прошла успешно подгатавливаем данные для записи в бд
        $id =(int)$id;
        $name = $this->db->escape($data['name']);
        $email = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);

        //добавляем условие что бы определить вставить запись в таб или обновить существующую
        if (!$id){
            $sql = "
            insert into messages
            set name = '{$name}',
            email ='{$email}',
            message = '{$message}'
            ";
        }
        //добавим запрос для обновления записи
        else{
            $sql = "
             update messages
            set name = '{$name}',
            email ='{$email}',
            message = '{$message}'
            where id = {$id}
            ";
        }
        return $this->db->query($sql);
        }
        public function getList(){
            $sql = "select * from messages where 1";
            return $this->db->query($sql);

        }

    }