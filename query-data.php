<?php 
/*
 * Plugin Name:       Adding a Custom Column in the Admin Area 
 * Description:       Handle the basics with this plugin.

 */

class Query_data_Wedevs_Academy_admin_Menu{

    private static $instance;

    public static function get_instance(){
        if(!self::$instance){
            self::$instance= new self();
        }
        return self::$instance;
    }

    private function __construct(){
        $this->require_classes();
    }


    public function require_classes(){
        
        require_once __DIR__. '/includes/admin-post-column.php';

        new Query_data_Wedevs_Academy_admin_Menu_custom_post();
    }

}

 Query_data_Wedevs_Academy_admin_Menu::get_instance();



