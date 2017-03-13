<?php

    if (! class_exists('bbCPF_Utils')) :

        class bbCPF_Utils {

            public function __constructor() {}

            public function get_fields() {

                if (bbCPF()->fields !== null && bbCPF()->fields->fetched === true)
                    $fields = bbCPF()->fields->fields;
                else
                    $fields = [];

                $fields = apply_filters('bbCPF_get_fields', $fields);

                return array_map(function($field) {

                    return array_merge($field, ['value' => get_user_meta(19, 'bbCPF_' . $field['name'], true) ?: (isset($field['default']) ? $field['default'] : '')]);

                }, $fields);

            }

            public function get_fields_by_section($section = false, $priority = false) {

                if ($section === false)  // Bail if we aren't given a specific section
                    return [];

                if (bbCPF()->fields->fetched === false) // Update fields if they aren't already
                    $fields = bbCPF()->fields->update();
                else
                    $fields = bbCPF()->fields->fields;

                return array_filter($fields, function($field)use($section, $priority) {

                   return $priority !== false ?
                       $priority === 'before' ?
                           isset($field['priority']) && $field['priority'] === $priority && $field['section'] === $section :
                           $field['section'] === $section && (isset($field['priority']) ? $field['priority'] === $priority : true) :
                       $field['section'] === $section;

                });

            }

        }

    endif;