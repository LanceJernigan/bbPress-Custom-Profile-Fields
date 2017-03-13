<?php

function bbCPF_get_bbp_template_path() {

    return bbCPF()->path . 'templates';

}

function bbCPF_register_bbp_theme_packages() {

    bbp_register_template_stack('bbCPF_get_bbp_template_path', 12);

}

add_action('bbp_register_theme_packages', 'bbCPF_register_bbp_theme_packages');