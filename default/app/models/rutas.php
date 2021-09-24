<?php

    class rutas extends ActiveRecord
    {
        public function getrutas($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: Id desc');
        }
    }

?>