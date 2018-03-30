<?php

/*
// Add to bottom of the file
*/

// Inserta JS en el cliente de Wordpress

add_action("wp_enqueue_scripts", "dcms_insertar_js");

function dcms_insertar_js(){
    
    wp_register_script('miscript', get_template_directory_uri(). '/assets/js/script.js', array('jquery'), '1', true );
    wp_enqueue_script('miscript');
    
}

// Inserta JS en el admin panel de Wordpress

function insertar_js_admin( $hook ) {
  wp_register_script('script-admin', get_template_directory_uri(). '/assets/js/script.js', array('jquery'), '1', true );
  wp_enqueue_script('script-admin');
}

add_action('admin_enqueue_scripts', 'insertar_js_admin');

// Inserta CSS en el admin panel de Wordpress

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo "<style>
  @import url('https://fonts.googleapis.com/css?family=Roboto');
    body, td, textarea, input, select {
      font-family: 'Roboto', sans-serif;
      font-size: 12px;
    } 
  </style>";
}

