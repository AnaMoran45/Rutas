<?php

    class zonas extends ActiveRecord
    {
        public function getZonas($page, $ppage=20){
            return $this->paginate("page: $page", "per_page: $ppage", 'order: Id desc');
        }
    }

?>