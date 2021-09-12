<?php
class OptionsDemoTwo{
    public function __construct(){
        add_action( 'admin_menu', array($this,'optionsdemo_create_admin_page2') );
        add_action( 'admin_post_optionsdemo_admin_page',array($this,'options_save_page') );
    }

    public function optionsdemo_create_admin_page2(){
        $page_title = __( 'Options demo', 'optionsdemo' );
        $menu_title = __( 'Options demo', 'optionsdemo' );
        $capability = 'manage_options';
        $slug       = 'optionsdemo';
        $callback   = [$this, 'optionsdemo_page_content2'];
        // add_options_page( $page_title, $menu_title, $capability, $slug, $callback );
        add_menu_page( $page_title, $menu_title, $capability, $slug, $callback );
    }

    public function optionsdemo_page_content2(){
       require_once plugin_dir_path(__FILE__)."/form.php";
    }

    public function options_save_page(){
        if (isset($_POST["optionsdemo_longitude"])) {
            update_option( 'optionsdemo_longitude',sanitize_text_field('optionsdemo_longitude'));
        }
        wp_redirect('admin.php?page=optionsdemo');
    }
}
new OptionsDemoTwo();

