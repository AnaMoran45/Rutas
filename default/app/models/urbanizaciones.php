<?php
    
    class urbanizaciones extends ActiveRecord{
        public function geturbanizaciones($page, $ppage=20)
        {
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        }
    }
?>