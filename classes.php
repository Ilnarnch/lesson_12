<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');

    class Ads { 
            private $id;
            public $id_c;


            private $type;
            private $seller_name;

            private $email;
            private $phone;
            private $city_id;
            private $allow_mail;
            private $category_id;

            private $name;

            private $price;

            private $desc;


            public function __construct($ad) {
                if(isset($ad['id'])){
                    $this->id=$ad['id'];
                }
                if(isset($ad['id_c'])){
                    $this->id_c=$ad['id_c'];
                }
                if(isset($ad['type'])){
                    $this->type=$ad['type'];
                }
                if(isset($ad['seller_name'])){
                    $this->seller_name=$ad['seller_name'];
                }
                if(isset($ad['email'])){
                    $this->email=$ad['email'];
                }
                if(isset($ad['phone'])){
                    $this->phone=$ad['phone'];
                }
                if(isset($ad['city_id'])){
                    $this->city_id=$ad['city_id'];
                }
                if(isset($ad['allow_mail'])){
                    $this->allow_mail=$ad['allow_mail'];
                }
                if(isset($ad['category_id'])){
                    $this->category_id=$ad['category_id'];
                }
                if(isset($ad['price'])){
                    $this->price=$ad['price'];
                }

                if(isset($ad['name'])){
                    $this->name=$ad['name'];
                }

                if(isset($ad['desc'])){
                    $this->desc=$ad['desc'];
                }
            }

            public function getId (){
                return $this->id;
            }
            public function getId_c (){
                return $this->id_c;
            }
            public function getType (){
                return $this->type;
            }
            public function getSellerNname (){
                return $this->seller_name;
            }
            public function getEmail (){
                return $this->email;
            }
            public function getPhone(){
                return $this->phone;
            }
            public function getCityId(){
                return $this->city_id;
            }
            public function getAllowMail(){
                return $this->allow_mail;
            }
            public function getCategoryId(){
                return $this->category_id;
            }
            public function getName (){
                return $this->name;
            }
            public function getPrice(){
                return $this->price;
            }
            public function getDesc (){
                return $this->desc;
            }

            public function save(){
                global $db;
                $vars = get_object_vars($this);// ФИЧА!!!
                $db->query('REPLACE INTO adStore (?#) VALUES (?a)', array_keys($vars), array_values($vars));
            }

            public function delete() {
                global $db;
                $id = $this->id;
                $db->query('DELETE FROM adStore WHERE id=?', $id);
            }

            function getAd(){                                              // возвращает объявление из базы по id
                global $db;
                return $db->selectRow('SELECT * FROM `adStore` WHERE `id`=?d', $this->id_c);
            }

             function editAd(){                                      // функция редактирования объявления
                 global $db;
                 $vars = get_object_vars($this);// ФИЧА!!!
                 $vars['id'] = $vars['id_c'];
                $db->query('UPDATE adStore SET ?a WHERE id=?d', $vars, $vars['id_c']);
            }
        }

        class AdsStore {
            private static $instance = NULL;
            public $ads = array();

            public static function instance (){
                if(self::$instance == NULL){
                    self::$instance = new AdsStore;
                }
                return self::$instance;
            }

            public function addAds(Ads $ad){
                if(!($this instanceof AdsStore)){
                    die('Нельзя использовать этом метод в конструкторах классов');
                }
                $this->ads[$ad->getId()] = $ad;
            }

            public function getAllAdsFromDb (){
                global $db;

                $all = $db->select('SELECT * FROM adStore');

                foreach($all as $value){
                    $ad = new Ads($value);
                    self::addAds($ad);
                }
                return self::instance();
            }

            public function prepareForOut(){
                global $smarty;
                $row = '';
                asort($this->ads); // чтобы объявления выводились в порядке возрастания id
                foreach($this->ads as $value){
                    $smarty->assign('ad', $value); // нужен для вывода в table_row.tpl.html
                    $row.=$smarty->fetch('table_row.tpl.html'); // строка ячеек таблицы
                }
                $smarty->assign('ads_rows',$row); // ячейки таблицы передаем для файла table.tpl

                return self::instance();
            }

            public function getCities(){                                                // возвращает список городов для селектора
               global $smarty;
               global $db;

               $cities_query = $db->select('SELECT id AS ARRAY_KEY,city FROM cities');

               foreach ($cities_query as $key=>$value) {                                   // приводим массив к соответствующему виду
                    $cities[$key] = $value['city'];                                         // для селектора smarty
               }

               $smarty->assign('cities', $cities);

//               return self::instance();
            } 

            public function getCategories(){
                global $smarty;
                global $db;

                $categories_query = $db->select('SELECT categories.id , categories.category, sections.section 
                                                  FROM categories
                                                  INNER JOIN sections ON (categories.parent_id=sections.parent_id)');
                $categories[]='';

                foreach ($categories_query as $key=>$value){

                    $categories[$value['section']][$value['id']]= $value['category'];
                }
                $smarty->assign('categories',$categories);
//                return self::instance();
            }

            public function display (){
                global $smarty;
                
                self::getCities();
                self::getCategories();
                
                $smarty->display('lesson_12_form.tpl');
            }
        }