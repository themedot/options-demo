<?php
    /*
    Plugin Name: Options Demo
    Plugin URI: http://example.com/
    Description: this is a option page plugin
    Version: 1.0
    Author: sadat himel
    Author URI: http://example.com/
    License: GPLv2 or later
    Text Domain: optionsdemo
    Domain Path: /languages
     */

    // Settings Page: optionsdemo
    // Retrieving values: get_option( 'your_field_id' )


    require_once plugin_dir_path(__FILE__)."/options_demo_form.php";

    class optionsdemo_Settings_Page {

        public function __construct() {
            add_action( 'admin_menu', [$this, 'optionsdemo_create_settings'] );
            add_action( 'admin_init', [$this, 'optionsdemo_setup_sections'] );
            add_action( 'admin_init', [$this, 'optionsdemo_setup_fields'] );
            add_action( 'plugin_loaded', [$this, 'optionsdemo_demo_textdomain'] );
            add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [$this, 'add_settings_link'] );
        }

        public function add_settings_link( $links ) {
            $url           = get_admin_url() . "/options-general.php?page=optionsdemo";
            $settings_link = '<a href="' . $url . '">' . __( 'Settings', 'optionsdemo' ) . '</a>';
            array_unshift( $links, $settings_link );

            return $links;
        }

        public function optionsdemo_demo_textdomain() {
            load_plugin_textdomain( 'option-demo', false, plugin_dir_path( __FILE__ ) . "/languages" );
        }

        public function optionsdemo_create_settings() {
            $page_title = __( 'Options demo', 'optionsdemo' );
            $menu_title = __( 'Options demo', 'optionsdemo' );
            $capability = 'manage_options';
            $slug       = 'optionsdemo';
            $callback   = [$this, 'optionsdemo_settings_content'];
            add_options_page( $page_title, $menu_title, $capability, $slug, $callback );

        }

            public function optionsdemo_settings_content() {
                ?>
                <div class="wrap">
                    <h1><?php __( 'Option Demo', 'optionsdemo' );?></h1>

                    <form method="POST" action="options.php">
                        <?php
                            settings_fields( 'optionsdemo' );
                                    do_settings_sections( 'optionsdemo' );
                                    submit_button();
                                ?>
                    </form>
                </div>
                            <?php
                                }


                public function optionsdemo_setup_sections() {
                    add_settings_section( 'optionsdemo_section', 'Demonstration of plugin setting ', [], 'optionsdemo' );
                }

                public function optionsdemo_setup_fields() {
                    $fields = [
                        [
                            'section'     => 'optionsdemo_section',
                            'label'       => __( 'Latitude ', 'optionsdemo' ),
                            'placeholder' => __( 'Latitude ', 'optionsdemo' ),
                            'id'          => 'option_latitude',
                            'type'        => 'text',
                        ],

                        [
                            'section'     => 'optionsdemo_section',
                            'label'       => __( 'Longitude', 'optionsdemo' ),
                            'placeholder' => __( 'Longitude', 'optionsdemo' ),
                            'id'          => 'option_longitude',
                            'type'        => 'text',
                        ],

                        [
                            'section' => 'optionsdemo_section',
                            'label'   => __( 'Zoom Level ', 'optionsdemo' ),
                            'id'      => 'option_zoom',
                            'type'    => 'text',
                        ],

                        [
                            'section' => 'optionsdemo_section',
                            'label'   => __( 'API key', 'optionsdemo' ),
                            'id'      => 'option_api',
                            'type'    => 'text',
                        ],

                        [
                            'section' => 'optionsdemo_section',
                            'label'   => __( 'External CSS', 'optionsdemo' ),
                            'id'      => 'option_external_CSS',
                            'type'    => 'textarea',
                        ],

                        [
                            'section' => 'optionsdemo_section',
                            'label'   => __( 'Expiry Date ', 'optionsdemo' ),
                            'id'      => 'option_expiry_date',
                            'type'    => 'date',
                        ],
                    ];
                    foreach ( $fields as $field ) {
                        add_settings_field( $field['id'], $field['label'], [$this, 'optionsdemo_field_callback'], 'optionsdemo', $field['section'], $field );
                        register_setting( 'optionsdemo', $field['id'] );
                    }
                }
                public function optionsdemo_field_callback( $field ) {
                    $value       = get_option( $field['id'] );
                    $placeholder = '';
                    if ( isset( $field['placeholder'] ) ) {
                        $placeholder = $field['placeholder'];
                    }
                    switch ( $field['type'] ) {

                    case 'textarea':
                        printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>',
                            $field['id'],
                            $placeholder,
                            $value
                        );
                        break;

                    default:
                        printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
                            $field['id'],
                            $field['type'],
                            $placeholder,
                            $value
                        );
                    }
                    if ( isset( $field['desc'] ) ) {
                        if ( $desc = $field['desc'] ) {
                            printf( '<p class="description">%s </p>', $desc );
                        }
                    }
                }

            }
        new optionsdemo_Settings_Page();                                                        
