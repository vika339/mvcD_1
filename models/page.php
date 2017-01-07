<?php
class Page extends Model {
    public function getList($only_published = false){
        $sql = "select * from pages where 1";
        if ($only_published){
            $sql .= "and is_published = 1";
        }
        return $this->db->query($sql);
    }


    //получить данные страницы по ее алиасу
    public function getByAlias($alias){
        // избежать sql иньекций
        $alias = $this->db->escape($alias);
        $sql = "select * from pages WHERE alias = '{$alias}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }


    //добавляем метод для id для корректного использования js
    public function getById($id){

        $id = (int)$id;
        $sql = "select * from pages WHERE id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }


    public function save($data, $id = null){
        //проверяем что єлемент есть в массиве
        if (!isset($data['alias']) || !isset($data['title']) || !isset($data['content'])){
            return false;

        }
        // если проверка прошла успешно подгатавливаем данные для записи в бд
        $id =(int)$id;
        $alias = $this->db->escape($data['alias']);
        $title = $this->db->escape($data['title']);
        $content = $this->db->escape($data['content']);
        $is_published = isset($data['is_published']) ? 1 : 0;

        //добавляем условие что бы определить вставить запись в таб или обновить существующую
        if (!$id){
            $sql = "
            insert into pages
            set alias = '{$alias}',
            title ='{$title}',
            content = '{$content}',
            is_published = {$is_published}
            ";
        }
        //добавим запрос для обновления записи
        else{
            $sql = "
             update pages
            set alias = '{$alias}',
            title ='{$title}',
            content = '{$content}',
            is_published = {$is_published}
            WHERE id = {$id}
            ";
        }
        return $this->db->query($sql);
    }
    public function delete($id){
        $id = (int)$id;
        $sql = "delete from pages WHERE id = $id";
        return $this->db->query($sql);
    }

}