<?php

    class Autobuses extends ActiveRecord
    {
        public function getAutobuses($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }
    }

?>