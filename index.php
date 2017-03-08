<?php

    /*
     * Plugin Name: bbPress Custom Profile Fields
     * Description: Adds custom fields to the bbPress profile
     * Author:  Lance Jernigan
     * Author URI: https://lancejernigan.com
     * Version: 0.0.1
     */

    if (! class_exists('bbCPF')) :

        class bbCPF {

            public  $isSaving = false,
                    $url = null,
                    $path = null,
                    $fields = null,
                    $utils = null;

            public function __construct() {}

            private function setup() {

                $this->isSaving = isset($_POST['bbCPF']);
                $this->url = plugin_dir_url(__FILE__);
                $this->path = plugin_dir_path(__FILE__);

            }

            private function includes() {

                include($this->path . 'includes/class-utils.php');
                include($this->path . 'includes/class-fields.php');

                $this->utils = new bbCPF_Utils;
                $this->fields = new bbCPF_Fields($this->isSaving);

            }

            public static function instance() {

                static $instance = null;

                if ($instance === null) {

                    $instance = new bbCPF;
                    $instance->setup();
                    $instance->includes();

                }

                return $instance = ($instance === null ? new bbCPF : $instance);

            }

        }

        function bbCPF() {

            return bbCPF::instance();

        }

    endif;

    function _log( $message ) {
        if( WP_DEBUG === true ){
            error_log("*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*");
            foreach (func_get_args() as $arg) {
                if( is_array( $arg ) || is_object( $arg ) ){
                    error_log( print_r( $arg, true ) );
                } else {
                    error_log( $arg );
                }
            }
            error_log("*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*");
        }
    }

    function my_custom_fields($fields) {

        $fields[] = [
            'label' => 'Phone',
            'name' => 'phone',
            'section' => 'contact',
            'priority' => 'before',
            'default' => '8653041322'
        ];

        return $fields;

    }

    add_filter('bbCPF_get_fields', 'my_custom_fields');

    bbCPF();