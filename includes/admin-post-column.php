<?php 


/**
 * 
 * In this file add will be custom post column 
 */



 class Query_data_Wedevs_Academy_admin_Menu_custom_post{

    /**
	 * Constructor
	 */
    public function __construct(){
        add_filter('manage_page_posts_columns', [$this, 'custom_post_colunm'], 10 ,1);
        add_action('wp_head', [$this, 'custom_post_count']);
        add_action("manage_page_posts_custom_column", [$this, 'manage_custon_wedevs'],10 ,2);
    }

    /**
     * add a cutom column for the thumbnail
     * 
     * @param mixed array $columns Array of existing columns.
     * @return  array Modified columns array with the new "Thumbnail" column
     */

    public function custom_post_colunm($columns){

        //debug korar jonno error log korte hoy 

           // error_log(print_r($columns,true));

                $new_columns=[];

                foreach($columns as  $key=>$column){

                    $new_columns[$key]=$column;

                    if('cb'=== $key){
                        $new_columns['image']="Thumbnail";
                    }
                    /**
                     * make a view count column 
                     */

                if('author'=== $key){
                    $new_columns['view']='view count';
                }
           }



        return $new_columns;
    }

    /**
     * 
     * Display content in the custom "image" column.
     */

    public function manage_custon_wedevs($column_name,  $post_id){

        if($column_name === "image"){

           if(has_post_thumbnail($post_id)){

            echo get_the_post_thumbnail($post_id, [50, 50]);

           }else{
            echo "no  image here";
           }
        }

        if ($column_name === "view") {
            $views = get_post_meta($post_id, 'view_count', true); // Assumes 'view_count' meta is used
            echo $views ? $views : 0;
        }

    }

    /**
     * post count treker
     */

     public function custom_post_count(){

        if(is_page()){
            global $post;

            $views = get_post_meta($post->ID, 'view_count', true);
            if(!$views){
                $views=0;
            }else{
                $views=intval($views);
            }

            $views +=1;
            
            /**
             * save for data blow the function update_post_meta
             * 
             */
            update_post_meta( $post->ID, 'view_count',$views);
        
        }
     }
 }


 