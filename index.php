<?php

    /*
     * Plugin Name: bbPress Custom Profile Fields
     * Description: Adds custom fields to the bbPress profile
     * Author:  Lance Jernigan
     * Author URI: https://lancejernigan.com
     * Version: 0.0.2
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
                include($this->path . 'includes/template-override.php');

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

        add_action('plugins_loaded', 'bbCPF');

    endif;