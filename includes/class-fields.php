<?php

    /*
     * bbCPF_Fields
     */

    if (! class_exists('bbCPF_Fields')) :

        class bbCPF_Fields {

            public  $fields = [],
                    $fetched = false;

            public function __construct($isSaving = false) {

                if ($isSaving) {

                    $this->save();

                }

                $this->update();
                $this->register_hooks();

            }

            public function update() {

                $this->fields = bbCPF()->utils->get_fields();
                $this->fetched = true;

                return $this->fields;

            }

            public function register_hooks() {

                // Hooks for Name Section
                add_action('bbp_user_edit_before_name', [__class__, 'display']);
                add_action('bbp_user_edit_after_name', [__class__, 'display']);

                // Hooks for Contact Section
                add_action('bbp_user_edit_before_contact', [__class__, 'display']);
                add_action('bbp_user_edit_after_contact', [__class__, 'display']);

                // Hooks for About Section
                add_action('bbp_user_edit_before_about', [__class__, 'display']);
                add_action('bbp_user_edit_after_about', [__class__, 'display']);

                // Hooks for Account Section
                add_action('bbp_user_edit_before_account', [__class__, 'display']);
                add_action('bbp_user_edit_after_account', [__class__, 'display']);

            }

            public static function display($edit = null, $section = null, $position = null) {

                $action = explode('_', current_filter());

                if (in_array('edit', $action))
                    $edit = true;

                if ($edit === true) {

                    $section = $action[4];
                    $position = $action[3];

                }

                echo array_reduce(bbCPF()->utils->get_fields_by_section($section, $position), function($template, $field) {

                    return $template . "<div><label for='{$field['name']}'>{$field['label']}</label><input type='text' name='bbCPF[{$field['name']}]' value='{$field['value']}'' /></div>";

                }, '');

            }

            private function save() {

                $user_id = 19;  // YMDC user

                if (isset($_POST['bbCPF'])) {

                    foreach($_POST['bbCPF'] as $name => $value) {

                        update_user_meta($user_id, 'bbCPF_' . $name, $value);

                    }

                }

            }

        }

    endif;