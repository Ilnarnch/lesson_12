<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');
  
    class ad {
 
        public $s_private;
        public $seller_name;
        public $email;
        public $phone;
        public $location_id;
        public $checkbox;
        public $category_id;
        public $title;
        public $description;
        public $price;
        
        public function get_ad($data) {
            $this->s_private = isset($data['s_private'])?$data['s_private']:'1';
            $this->seller_name = isset($data['seller_name'])?$data['seller_name']:'';
            $this->email = isset($data['email'])?$data['email']:'';
            $this->phone = isset($data['phone'])?$data['phone']:'';
            $this->location_id = isset($data['location_id'])?$data['location_id']:'';
            $this->checkbox = isset($data['checkbox'])?$data['checkbox']:'';
            $this->category_id = isset($data['category_id'])?$data['category_id']:'';
            $this->title = isset($data['title'])?$data['title']:'';
            $this->description = isset($data['description'])?$data['description']:'';
            $this->price = isset($data['price'])?$data['price']:'';
        }
    }

    class addAd{
        public $ads_o;
        
        public function get_ad($object_ad){
            $this->ads_o=$object_ad;
            return $this->ads_o;
        }
    }